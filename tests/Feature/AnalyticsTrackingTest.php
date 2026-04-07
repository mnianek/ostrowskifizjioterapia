<?php

use App\Livewire\PostComments;
use App\Models\Comment;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\SiteStat;
use App\Models\YoutubePageSetting;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('tracks first traffic source once per session', function () {
    get('/?utm_source=google')->assertOk();
    get(route('posts.index'))->assertOk();

    assertDatabaseHas('site_stats', [
        'key' => 'unique_visits',
        'value' => 1,
    ]);

    assertDatabaseHas('site_stats', [
        'key' => 'source:google',
        'value' => 1,
    ]);
});

it('tracks youtube cta click and redirects to channel', function () {
    YoutubePageSetting::query()->create(YoutubePageSetting::defaults());

    get(route('analytics.youtube-channel'))
        ->assertRedirect('https://www.youtube.com/@ostrowskifizjoterapia');

    assertDatabaseHas('site_stats', [
        'key' => 'cta_youtube_channel_clicks',
        'value' => 1,
    ]);
});

it('tracks newsletter submissions and unique conversions', function () {
    post(route('newsletter.subscribe'), [
        'email' => 'kpi@example.com',
        'privacy_consent' => '1',
    ])->assertRedirect();

    post(route('newsletter.subscribe'), [
        'email' => 'kpi@example.com',
        'privacy_consent' => '1',
    ])->assertRedirect();

    expect(NewsletterSubscriber::query()->count())->toBe(1);

    assertDatabaseHas('site_stats', [
        'key' => 'newsletter_submissions',
        'value' => 2,
    ]);

    assertDatabaseHas('site_stats', [
        'key' => 'newsletter_new_subscribers',
        'value' => 1,
    ]);
});

it('tracks comment submissions from livewire component', function () {
    $post = Post::query()->create([
        'title' => 'Analityka komentarzy',
        'slug' => 'analityka-komentarzy',
        'content' => 'Tresc testowa wpisu',
        'author' => 'Autor',
        'status' => 'published',
    ]);

    $parentComment = Comment::query()->create([
        'post_id' => $post->id,
        'user_name' => 'Jan',
        'content' => 'Komentarz nadrzędny',
        'is_approved' => true,
    ]);

    Livewire::test(PostComments::class, ['post' => $post])
        ->set('userName', 'Anna')
        ->set('content', 'Nowy komentarz')
        ->call('addComment')
        ->call('toggleReplyForm', $parentComment->id)
        ->set('replyUserName', 'Ola')
        ->set('replyContent', 'Nowa odpowiedz')
        ->call('addReply');

    assertDatabaseHas('site_stats', [
        'key' => 'comments_submitted',
        'value' => 2,
    ]);
});

it('calculates conversion-related stats values in storage', function () {
    SiteStat::query()->create(['key' => 'unique_visits', 'value' => 20]);
    SiteStat::query()->create(['key' => 'cta_youtube_channel_clicks', 'value' => 5]);
    SiteStat::query()->create(['key' => 'newsletter_submissions', 'value' => 10]);
    SiteStat::query()->create(['key' => 'newsletter_new_subscribers', 'value' => 4]);

    expect((int) SiteStat::query()->where('key', 'unique_visits')->value('value'))->toBe(20);
    expect((int) SiteStat::query()->where('key', 'cta_youtube_channel_clicks')->value('value'))->toBe(5);
    expect((int) SiteStat::query()->where('key', 'newsletter_submissions')->value('value'))->toBe(10);
    expect((int) SiteStat::query()->where('key', 'newsletter_new_subscribers')->value('value'))->toBe(4);
});
