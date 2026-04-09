<?php

use App\Models\Post;

use function Pest\Laravel\get;

it('keeps noindex canonical strategy on filtered blog pages', function () {
    Post::query()->create([
        'title' => 'Regresja filtr SEO',
        'slug' => 'regresja-filtr-seo',
        'content' => 'Tresc testowa',
        'author' => 'Admin',
        'status' => 'published',
        'is_published' => true,
        'published_at' => now()->subMinute(),
    ]);

    get(route('posts.index', ['search' => 'Regresja']))
        ->assertOk()
        ->assertSee('<link rel="canonical" href="'.route('posts.index').'">', false)
        ->assertSee('<meta name="robots" content="noindex,follow">', false);
});

it('keeps scheduled posts hidden from public listing and details', function () {
    Post::query()->create([
        'title' => 'Regresja harmonogram',
        'slug' => 'regresja-harmonogram',
        'content' => 'Tresc harmonogramu',
        'author' => 'Admin',
        'status' => 'scheduled',
        'is_published' => true,
        'published_at' => now()->addDay(),
    ]);

    get(route('posts.index'))
        ->assertOk()
        ->assertDontSee('Regresja harmonogram');

    get(route('posts.show', 'regresja-harmonogram'))->assertNotFound();
});
