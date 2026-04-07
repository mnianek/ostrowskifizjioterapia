<?php

use App\Livewire\PostComments;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('allows post author to pin comment and replaces previous pin', function () {
    $author = User::factory()->create(['name' => 'Autor']);

    $post = Post::query()->create([
        'title' => 'Post testowy',
        'slug' => 'post-testowy-pinning',
        'content' => 'Treść',
        'author' => 'Autor',
        'author_id' => $author->id,
        'status' => 'published',
    ]);

    $firstComment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Pierwszy komentarz',
        'is_approved' => true,
    ]);

    $secondComment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Anna',
        'content' => 'Drugi komentarz',
        'is_approved' => true,
    ]);

    actingAs($author);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('pinComment', $firstComment->id)
        ->call('pinComment', $secondComment->id);

    assertDatabaseHas('comments', [
        'id' => $firstComment->id,
        'is_pinned' => false,
    ]);

    assertDatabaseHas('comments', [
        'id' => $secondComment->id,
        'is_pinned' => true,
    ]);
});

it('prevents non author from pinning comment', function () {
    $author = User::factory()->create(['name' => 'Autor']);
    $otherUser = User::factory()->create(['name' => 'Inny']);

    $post = Post::query()->create([
        'title' => 'Post testowy 2',
        'slug' => 'post-testowy-pinning-2',
        'content' => 'Treść',
        'author' => 'Autor',
        'author_id' => $author->id,
        'status' => 'published',
    ]);

    $comment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Komentujący',
        'content' => 'Komentarz',
        'is_approved' => true,
    ]);

    actingAs($otherUser);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('pinComment', $comment->id)
        ->assertStatus(403);
});

it('creates nested reply with parent id', function () {
    $post = Post::query()->create([
        'title' => 'Post do odpowiedzi',
        'slug' => 'post-odpowiedzi',
        'content' => 'Treść',
        'author' => 'Autor',
        'status' => 'published',
    ]);

    $parentComment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Komentarz główny',
        'is_approved' => true,
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('toggleReplyForm', $parentComment->id)
        ->set('replyUserName', 'Anna')
        ->set('replyContent', 'To jest odpowiedź')
        ->call('addReply');

    assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'parent_id' => $parentComment->id,
        'user_name' => 'Anna',
        'content' => 'To jest odpowiedź',
        'is_approved' => false,
    ]);
});

it('toggles likes for authenticated user', function () {
    $user = User::factory()->create();

    $post = Post::query()->create([
        'title' => 'Post do lajków',
        'slug' => 'post-lajki',
        'content' => 'Treść',
        'author' => 'Autor',
        'author_id' => $user->id,
        'status' => 'published',
    ]);

    $comment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Komentarz do polubienia',
        'is_approved' => true,
    ]);

    actingAs($user);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('toggleLike', $comment->id);

    assertDatabaseHas('comment_like', [
        'user_id' => $user->id,
        'comment_id' => $comment->id,
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('toggleLike', $comment->id);

    assertDatabaseMissing('comment_like', [
        'user_id' => $user->id,
        'comment_id' => $comment->id,
    ]);
});
