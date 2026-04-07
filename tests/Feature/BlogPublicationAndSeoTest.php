<?php

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Permission;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

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

it('protects post creation routes from guests and allows permitted users', function () {
    get(route('posts.create'))->assertForbidden();

    $user = User::factory()->create();

    Permission::findOrCreate('Create:Post', 'web');
    $user->givePermissionTo('Create:Post');

    actingAs($user)
        ->get(route('posts.create'))
        ->assertOk();
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
