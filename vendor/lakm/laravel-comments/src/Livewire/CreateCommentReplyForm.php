<?php

namespace LakM\Comments\Livewire;

use GrahamCampbell\Security\Facades\Security;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use LakM\Comments\Abstracts\AbstractQueries;
use LakM\Comments\Actions\CreateCommentReplyAction;
use LakM\Comments\Contracts\CommentableContract;
use LakM\Comments\Data\UserData;
use LakM\Comments\Exceptions\ReplyLimitExceededException;
use LakM\Comments\Models\Comment;
use LakM\Comments\ValidationRules;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class CreateCommentReplyForm extends Component
{
    use UsesSpamProtection;

    public bool $show = false;

    #[Locked]
    public Comment $comment;

    /** @var Model&CommentableContract  */
    #[Locked]
    public Model $relatedModel;

    private AbstractQueries $queries;

    #[Locked]
    public bool $loginRequired;

    #[Locked]
    public bool $limitExceeded;

    #[Locked]
    public bool $approvalRequired;

    public HoneypotData $honeyPostData;

    public ?UserData $guest = null;

    public ?string $guest_name = '';

    public ?string $guest_email = '';

    public string $text = "";

    public string $editorId;

    #[Locked]
    public bool $authenticated;

    #[Locked]
    public bool $guestMode;

    public int $replyCount;

    public function boot(): void
    {
        $this->queries = app(AbstractQueries::class);
    }

    /**
     * @param  Comment  $comment
     * @param  Model&CommentableContract  $relatedModel
     * @param  bool  $guestMode
     * @return void
     */
    public function mount(Comment $comment, Model $relatedModel, bool $guestMode): void
    {
        if (!$this->show) {
            $this->skipRender();
        }

        $this->comment = $comment;
        $this->relatedModel = $relatedModel;

        $this->guestMode = $guestMode;

        $this->authenticated = $this->relatedModel->authCheck();

        $this->editorId = Str::uuid();

        $this->setLoginRequired();

        $this->setApprovalRequired();

        $this->honeyPostData = new HoneypotData();

    }

    public function rules(): array
    {
        return ValidationRules::get($this->relatedModel, 'create');
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(CreateCommentReplyAction $replyAction): void
    {
        $this->protectAgainstSpam();

        $this->validate();

        if (!$this->guestMode) {
            Gate::authorize('create-reply');
        }

        throw_if($this->limitExceeded, ReplyLimitExceededException::make($this->replyLimit()));

        CreateCommentReplyAction::execute($this->comment, $this->getFormData(), $this->guestMode, $this->guest);

        $this->dispatch(
            'reply-created-' . $this->comment->id,
            editorId: $this->editorId,
            commentId: $this->comment->getKey(),
            approvalRequired: $this->approvalRequired
        );

        $this->dispatch('reset-editor-' . $this->editorId, value: "");

        if ($this->guestMode && (!$this->guest->name ||
            ($this->guest->name !== $this->guest_name || $this->guest->email !== $this->guest_email))) {
            $this->dispatch('guest-credentials-changed');
        }

        $this->incrementReplyCount();

        $this->setLimitExceeded();

        $this->clear();

        $this->setGuest();
    }

    private function getFormData(): array
    {
        $data = $this->only('guest_name', 'guest_email', 'text');
        return $this->clearFormData($data);
    }

    private function clearFormData(array $data): array
    {
        return array_map(function (string $value) {
            return Security::clean($value);
        }, $data);
    }

    public function discard(): void
    {
        $this->dispatch('reply-discarded', commentId: $this->comment->getKey());
        $this->dispatch('reset-editor-' . $this->editorId, value: '');
    }

    public function setLoginRequired(): void
    {
        $this->loginRequired = !$this->authenticated && !$this->guestMode;

        if ($this->loginRequired) {
            $this->dispatch('disable-editor-' . $this->editorId);
        }
    }

    public function incrementReplyCount(): void
    {
        if ($this->approvalRequired) {
            return;
        }

        $this->replyCount += 1;
    }

    public function setLimitExceeded(): void
    {
        $limit = $this->replyLimit();

        if (is_null($limit)) {
            $this->limitExceeded = false;
            return;
        }

        $this->limitExceeded = $this->replyCount >= $limit;

        if ($this->limitExceeded) {
            $this->dispatch('disable-editor-' . $this->editorId);
        }
    }

    public function setApprovalRequired(): void
    {
        $this->approvalRequired = config('comments.reply.approval_required');
    }

    public function replyLimit(): ?int
    {
        return config('comments.reply.limit');
    }

    private function setGuest(): void
    {
        if ($this->guestMode) {
            $this->guest = $this->queries->guest();

            $this->guest_name = $this->guest->name;
            $this->guest_email = $this->guest->email;

            return;
        }

        $this->guest = new UserData(null, null);
    }

    public function setReplyCount(): void
    {
        $this->replyCount = $this->queries->userReplyCountForComment(
            $this->comment,
            $this->guestMode,
            $this->relatedModel->getAuthUser()
        );
    }

    public function clear(): void
    {
        $this->resetValidation();
        $this->reset('text');
    }

    public function redirectToLogin(string $redirectUrl): void
    {
        session(['url.intended' => $redirectUrl]);
        $this->redirect(config('comments.login_route'));
    }

    #[On('show-create-reply-form-{comment.id}')]
    public function showForm(): void
    {
        if (!$this->show) {
            $this->show = true;
        }

        if (!isset($this->replyCount)) {
            $this->setReplyCount();
        }

        if ($this->show && !isset($this->limitExceeded)) {
            $this->setLimitExceeded();
        }

        $this->setGuest();
    }

    public function render(): View|Factory|Application
    {
        return view('comments::livewire.create-comment-reply-form');
    }
}
