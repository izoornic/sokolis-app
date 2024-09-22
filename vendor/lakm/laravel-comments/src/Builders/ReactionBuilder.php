<?php

namespace LakM\Comments\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LakM\Comments\Models\Reaction;

/**
 * @template TModelClass of Reaction
 * @extends Builder<Reaction>
 * @method ReactionBuilder whereApproved(bool $value)
 * @method ReactionBuilder whereType(string $value)
 */
class ReactionBuilder extends Builder
{
    /**
     * @param  bool  $authMode
     * @return ReactionBuilder<Reaction>
     */
    public function checkMode(bool $authMode): self
    {
        return $this->when(
            $authMode,
            function (ReactionBuilder $query) {
                return $query->authMode();
            },
            function (ReactionBuilder $query) {
                return $query->guestMode();
            }
        );
    }

    /** @return ReactionBuilder<Reaction> */
    public function guestMode(): self
    {
        return $this->where('user_id', null)
            ->where('ip_address', request()->ip());
    }

    /** @return ReactionBuilder<Reaction> */
    public function authMode(): self
    {
        return $this->where('user_id', Auth::id());
    }
}
