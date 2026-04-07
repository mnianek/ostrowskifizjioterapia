<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    public function created(Post $post): void
    {
        $this->log($post, 'created');
    }

    public function updated(Post $post): void
    {
        $changes = [];

        foreach ($post->getChanges() as $key => $newValue) {
            if ($key === 'updated_at') {
                continue;
            }

            $changes[$key] = [
                'old' => $post->getOriginal($key),
                'new' => $newValue,
            ];
        }

        if ($changes === []) {
            return;
        }

        $action = array_key_exists('status', $changes) || array_key_exists('is_published', $changes)
            ? 'publish_state_changed'
            : 'updated';

        $this->log($post, $action, $changes);
    }

    public function deleted(Post $post): void
    {
        $this->log($post, 'deleted');
    }

    private function log(Post $post, string $action, array $properties = []): void
    {
        ActivityLog::create([
            'causer_id' => Auth::id(),
            'subject_type' => $post::class,
            'subject_id' => $post->id,
            'action' => $action,
            'properties' => $properties,
            'ip_address' => request()?->ip(),
            'user_agent' => (string) request()?->userAgent(),
        ]);
    }
}
