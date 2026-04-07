<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        $this->log($comment, 'created');
    }

    public function updated(Comment $comment): void
    {
        $changes = [];

        foreach ($comment->getChanges() as $key => $newValue) {
            if ($key === 'updated_at') {
                continue;
            }

            $changes[$key] = [
                'old' => $comment->getOriginal($key),
                'new' => $newValue,
            ];
        }

        if ($changes === []) {
            return;
        }

        $action = 'updated';

        if (array_key_exists('is_approved', $changes)) {
            $action = $comment->is_approved ? 'approved' : 'unapproved';
        }

        if (array_key_exists('is_pinned', $changes)) {
            $action = $comment->is_pinned ? 'pinned' : 'unpinned';
        }

        $this->log($comment, $action, $changes);
    }

    public function deleted(Comment $comment): void
    {
        $this->log($comment, 'deleted');
    }

    private function log(Comment $comment, string $action, array $properties = []): void
    {
        ActivityLog::create([
            'causer_id' => Auth::id(),
            'subject_type' => $comment::class,
            'subject_id' => $comment->id,
            'action' => $action,
            'properties' => $properties,
            'ip_address' => request()?->ip(),
            'user_agent' => (string) request()?->userAgent(),
        ]);
    }
}
