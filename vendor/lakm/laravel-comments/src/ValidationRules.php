<?php

namespace LakM\Comments;

use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use LakM\Comments\Contracts\CommentableContract;

class ValidationRules
{
    /** @var callable|null $createCommentUsing */
    protected static $createCommentUsing;

    /** @var callable|null $updateCommentUsing */
    protected static $updateCommentUsing;

    /**
     * @param  Model  $model
     * @param  string  $type
     * @return array|array[]
     */
    public static function get(Model $model, string $type): array
    {
        if ($type === 'create' && is_a($model, CommentableContract::class)) {
            return self::createCommentRules($model);
        }
        if ($type === 'update') {
            return self::updateCommentRules($model);
        }

        throw new InvalidArgumentException('Invalid operation');
    }

    /**
     * @param  Model&CommentableContract  $model
     * @return array
     */
    private static function createCommentRules(Model $model): array
    {
        if (!isset(self::$createCommentUsing)) {
            return self::getCreateCommentRules($model);
        }

        return call_user_func(self::$createCommentUsing, $model);
    }

    private static function updateCommentRules(Model $model)
    {
        if (!isset(self::$updateCommentUsing)) {
            return self::getUpdateCommentRules();
        }

        return call_user_func(self::$updateCommentUsing, $model);
    }

    /**
     * @param  Model&CommentableContract  $model
     * @return array
     */
    private static function getCreateCommentRules(Model $model): array
    {
        $commentModel = config('comments.model');
        $commentTableName = (new $commentModel())->getTable();

        return [
            'guest_email' => [
                new RequiredIf($model->guestModeEnabled() && config('comments.guest_mode.email_enabled')),
                'nullable',
                'email',
                Rule::unique($commentTableName, 'guest_email')->ignore(request()->ip(), 'ip_address')
            ],
            'guest_name' => [
                new RequiredIf($model->guestModeEnabled()),
                Rule::unique($commentTableName, 'guest_name')->ignore(request()->ip(), 'ip_address')
            ],
            'text' => ['required'],
        ];
    }

    private static function getUpdateCommentRules(): array
    {
        return [
            'text' => ['required']
        ];
    }

    public static function createCommentUsing(callable $callable): void
    {
        self::$createCommentUsing = $callable;
    }

    public static function updateCommentUsing(callable $callable): void
    {
        self::$updateCommentUsing = $callable;
    }
}
