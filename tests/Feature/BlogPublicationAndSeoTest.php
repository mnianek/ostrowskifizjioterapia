<?php

use App\Models\Post;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows only published posts on blog index', function () {
    $published = Post::query()->create([
        'title' => 'Widoczny wpis',
        'slug' => 'widoczny-wpis',
        'lead' => 'Lead',
        'content' => 'Tresc opublikowana',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now()->subHour(),
    ]);

    Post::query()->create([
        'title' => 'Szkic wpisu',
        'slug' => 'szkic-wpisu',
        'content' => 'Tresc szkicu',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    $response = get(route('posts.index'));

    $response->assertOk();
    $response->assertSee($published->title);
    $response->assertDontSee('Szkic wpisu');
});

it('returns 404 when trying to open draft post page', function () {
    Post::query()->create([
        'title' => 'Szkic wpisu',
        'slug' => 'szkic-niewidoczny',
        'content' => 'Tresc szkicu',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    get('/blog/szkic-niewidoczny')->assertNotFound();
});

it('does not expose public post creation routes outside admin panel', function () {
    get('/posts/create')->assertNotFound();

    post('/posts', [
        'title' => 'Nowy wpis',
        'slug' => 'nowy-wpis',
        'author' => 'Admin',
        'content' => 'Tresc testowa wpisu poza panelem.',
    ])->assertNotFound();
});

it('hides scheduled post until publication date', function () {
    Post::query()->create([
        'title' => 'Wpis zaplanowany',
        'slug' => 'wpis-zaplanowany',
        'content' => 'Tresc zaplanowana',
        'author' => 'Admin',
        'status' => 'scheduled',
        'is_published' => true,
        'published_at' => now()->addDay(),
    ]);

    get(route('posts.index'))
        ->assertOk()
        ->assertDontSee('Wpis zaplanowany');

    get('/blog/wpis-zaplanowany')->assertNotFound();
});

it('renders feed and sitemap using only published posts', function () {
    Post::query()->create([
        'title' => 'RSS wpis',
        'slug' => 'rss-wpis',
        'content' => 'Tresc rss',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    Post::query()->create([
        'title' => 'Ukryty szkic',
        'slug' => 'ukryty-szkic',
        'content' => 'Tresc',
        'author' => 'Admin',
        'status' => 'draft',
        'is_published' => false,
    ]);

    get(route('posts.feed'))
        ->assertOk()
        ->assertSee('rss-wpis')
        ->assertDontSee('ukryty-szkic');

    get(route('sitemap'))
        ->assertOk()
        ->assertSee('rss-wpis')
        ->assertDontSee('ukryty-szkic');
});

it('renders canonical and og tags on post page', function () {
    $post = Post::query()->create([
        'title' => 'Meta wpis',
        'slug' => 'meta-wpis',
        'lead' => 'Meta lead',
        'content' => 'Meta tresc',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now(),
    ]);

    $response = get(route('posts.show', $post->slug));

    $response->assertOk();
    $response->assertSee('<link rel="canonical" href="'.route('posts.show', $post->slug).'">', false);
    $response->assertSee('<meta property="og:type" content="article">', false);
    $response->assertSee('application/ld+json', false);
});

it('applies seo pagination strategy on blog index', function () {
    foreach (range(1, 12) as $index) {
        Post::query()->create([
            'title' => 'SEO paginacja '.$index,
            'slug' => 'seo-paginacja-'.$index,
            'lead' => 'Lead '.$index,
            'content' => 'Tresc wpisu seo paginacja '.$index,
            'author' => 'Admin',
            'status' => 'published',
            'is_published' => true,
            'published_at' => now()->subMinutes($index),
        ]);
    }

    $pageOne = get(route('posts.index'));

    $pageOne->assertOk();
    $pageOne->assertSee('<link rel="canonical" href="'.route('posts.index').'">', false);
    $pageOne->assertSee('<meta name="robots" content="index,follow">', false);

    $pageTwo = get(route('posts.index', ['page' => 2]));

    $pageTwo->assertOk();
    $pageTwo->assertSee('<link rel="canonical" href="'.route('posts.index', ['page' => 2]).'">', false);
    $pageTwo->assertSee('<meta name="robots" content="noindex,follow">', false);
    $pageTwo->assertSee('<link rel="prev" href="', false);
    $pageTwo->assertDontSee('rel="next"', false);
});

it('uses duplicate-content strategy for filtered blog listing', function () {
    $post = Post::query()->create([
        'title' => 'SEO filtr',
        'slug' => 'seo-filtr',
        'content' => 'Tresc do filtrowania',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now()->subHour(),
    ]);

    $response = get(route('posts.index', ['search' => 'SEO']));

    $response->assertOk();
    $response->assertSee($post->title);
    $response->assertSee('<link rel="canonical" href="'.route('posts.index').'">', false);
    $response->assertSee('<meta name="robots" content="noindex,follow">', false);
});

it('renders dynamic og image endpoint for published post', function () {
    $post = Post::query()->create([
        'title' => 'OG grafika wpisu',
        'slug' => 'og-grafika-wpisu',
        'content' => 'Tresc wpisu dla OG',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now()->subHour(),
    ]);

    get(route('posts.og-image', $post->slug))
        ->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml; charset=UTF-8')
        ->assertSee('OG grafika wpisu', false);
});
