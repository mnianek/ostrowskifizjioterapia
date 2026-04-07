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
        ->call('addReply')
        ->assertSee('To jest odpowiedź')
        ->assertSee('Oczekuje na zatwierdzenie');

    assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'parent_id' => $parentComment->id,
        'user_name' => 'Anna',
        'content' => 'To jest odpowiedź',
        'is_approved' => false,
    ]);
});

it('shows freshly created top-level comment while it waits for approval', function () {
    $post = Post::query()->create([
        'title' => 'Post do komentarza',
        'slug' => 'post-do-komentarza',
        'content' => 'Treść',
        'author' => 'Autor',
        'status' => 'published',
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->set('userName', 'Anna')
        ->set('content', 'Mój nowy komentarz')
        ->call('addComment')
        ->assertSee('Mój nowy komentarz')
        ->assertSee('Oczekuje na zatwierdzenie');

    assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'parent_id' => null,
        'user_name' => 'Anna',
        'content' => 'Mój nowy komentarz',
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

it('toggles likes for guest user without login', function () {
    $post = Post::query()->create([
        'title' => 'Post do lajków gościa',
        'slug' => 'post-lajki-goscia',
        'content' => 'Treść',
        'author' => 'Autor',
        'status' => 'published',
    ]);

    $comment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Komentarz do polubienia przez gościa',
        'is_approved' => true,
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('toggleLike', $comment->id);

    $guestToken = session('comment_guest_like_token');

    expect($guestToken)->toBeString()->not->toBe('');

    assertDatabaseHas('comment_guest_like', [
        'comment_id' => $comment->id,
        'guest_token' => $guestToken,
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->call('toggleLike', $comment->id);

    assertDatabaseMissing('comment_guest_like', [
        'comment_id' => $comment->id,
        'guest_token' => $guestToken,
    ]);
});
