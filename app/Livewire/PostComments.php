<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PostComments extends Component
{
    public Post $post;

    public string $userName = '';

    public string $content = '';

    public ?int $replyingTo = null;

    public string $replyUserName = '';

    public string $replyContent = '';

    public function mount(Post $post): void
    {
        $this->post = $post;

        if (Auth::check()) {
            $name = trim((string) Auth::user()?->name);
            $this->userName = $name;
            $this->replyUserName = $name;
        }
    }

    public function addComment(): void
    {
        $validated = $this->validate([
            'userName' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:5000'],
        ]);

        $this->post->comments()->create([
            'user_name' => $validated['userName'],
            'content' => $validated['content'],
            'is_approved' => false,
            'parent_id' => null,
            'is_pinned' => false,
        ]);

        $this->content = '';

        session()->flash('comment_status', 'Twój komentarz oczekuje na zatwierdzenie przez administratora.');
    }

    public function toggleReplyForm(int $commentId): void
    {
        if ($this->replyingTo === $commentId) {
            $this->replyingTo = null;
            $this->replyContent = '';

            return;
        }

        $this->replyingTo = $commentId;

        if (Auth::check() && blank($this->replyUserName)) {
            $this->replyUserName = (string) Auth::user()?->name;
        }
    }

    public function addReply(): void
    {
        $parentId = $this->replyingTo;

        if (! $parentId) {
            return;
        }

        $parentComment = $this->post->comments()
            ->whereNull('parent_id')
            ->where('id', $parentId)
            ->first();

        if (! $parentComment) {
            return;
        }

        $validated = $this->validate([
            'replyUserName' => ['required', 'string', 'max:255'],
            'replyContent' => ['required', 'string', 'max:5000'],
        ]);

        $this->post->comments()->create([
            'user_name' => $validated['replyUserName'],
            'content' => $validated['replyContent'],
            'is_approved' => false,
            'parent_id' => $parentComment->id,
            'is_pinned' => false,
        ]);

        $this->replyingTo = null;
        $this->replyContent = '';

        session()->flash('comment_status', 'Twoja odpowiedź oczekuje na zatwierdzenie przez administratora.');
    }

    public function pinComment(int $commentId): void
    {
        if (! $this->canPinComments()) {
            abort(403);
        }

        $comment = $this->post->comments()
            ->where('id', $commentId)
            ->whereNull('parent_id')
            ->firstOrFail();

        DB::transaction(function () use ($comment): void {
            $this->post->comments()->update(['is_pinned' => false]);
            $comment->update(['is_pinned' => true]);
        });
    }

    public function toggleLike(int $commentId)
    {
        $user = $this->getCurrentUser();

        if (! $user) {
            return redirect()->route('login');
        }

        $comment = $this->post->comments()
            ->where('id', $commentId)
            ->where('is_approved', true)
            ->firstOrFail();

        $user->likedComments()->toggle($comment->id);

        return null;
    }

    public function canPinComments(): bool
    {
        $user = $this->getCurrentUser();

        if (! $user) {
            return false;
        }

        if (filled($this->post->author_id)) {
            return (int) $this->post->author_id === (int) $user->id;
        }

        return (string) $this->post->author === (string) $user->name;
    }

    public function userLikedComment(Comment $comment): bool
    {
        $user = $this->getCurrentUser();

        if (! $user) {
            return false;
        }

        return $comment->likes->contains('id', $user->id);
    }

    public function render()
    {
        $authId = Auth::id();

        $comments = $this->post->comments()
            ->whereNull('parent_id')
            ->where('is_approved', true)
            ->withCount('likes')
            ->with([
                'likes' => fn ($query) => $query
                    ->when($authId, fn ($userQuery) => $userQuery->where('users.id', $authId)),
                'replies' => fn ($query) => $query
                    ->where('is_approved', true)
                    ->withCount('likes')
                    ->with([
                        'likes' => fn ($replyLikesQuery) => $replyLikesQuery
                            ->when($authId, fn ($userQuery) => $userQuery->where('users.id', $authId)),
                    ])
                    ->latest(),
            ])
            ->orderByDesc('is_pinned')
            ->latest()
            ->get();

        return view('livewire.post-comments', [
            'comments' => $comments,
        ]);
    }

    protected function getCurrentUser(): ?User
    {
        $user = Auth::user();

        if (! ($user instanceof User)) {
            return null;
        }

        return $user;
    }
}
