<?php

use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

it('creates activity log entries for post create and update', function () {
    $user = User::factory()->create();
    actingAs($user);

    $post = Post::query()->create([
        'title' => 'Log post',
        'slug' => 'log-post',
        'content' => 'Tresc',
        'author' => 'Autor',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $post->update(['title' => 'Log post po zmianie']);

    assertDatabaseHas('activity_logs', [
        'subject_type' => Post::class,
        'subject_id' => $post->id,
        'action' => 'created',
        'causer_id' => $user->id,
    ]);

    assertDatabaseHas('activity_logs', [
        'subject_type' => Post::class,
        'subject_id' => $post->id,
        'action' => 'updated',
        'causer_id' => $user->id,
    ]);
});

it('creates moderation activity log for comment approval', function () {
    $user = User::factory()->create();
    actingAs($user);

    $post = Post::query()->create([
        'title' => 'Post komentarz',
        'slug' => 'post-komentarz-log',
        'content' => 'Tresc',
        'author' => 'Autor',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $comment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Komentarz',
        'is_approved' => false,
    ]);

    $comment->update(['is_approved' => true]);

    assertDatabaseHas('activity_logs', [
        'subject_type' => Comment::class,
        'subject_id' => $comment->id,
        'action' => 'approved',
        'causer_id' => $user->id,
    ]);

    expect(ActivityLog::query()->where('subject_id', $comment->id)->exists())->toBeTrue();
});
