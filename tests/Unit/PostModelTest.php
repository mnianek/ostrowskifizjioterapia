<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('normalizes slug and auto-builds excerpt while saving', function () {
    $post = Post::query()->create([
        'title' => 'Nowy Tytul Testowy',
        'slug' => 'Niestandardowy Slug 123',
        'content' => str_repeat('Tresc testowa ', 40),
        'author' => 'Autor',
        'status' => Post::STATUS_DRAFT,
    ]);

    expect($post->slug)->toBe('niestandardowy-slug-123');
    expect($post->excerpt)->not->toBeNull();
    expect($post->is_published)->toBeFalse();
    expect($post->published_at)->toBeNull();
});

it('auto-publishes timestamp for published status', function () {
    $post = Post::query()->create([
        'title' => 'Publikowany wpis',
        'slug' => 'publikowany-wpis',
        'content' => 'Tresci publikowane',
        'author' => 'Autor',
        'status' => Post::STATUS_PUBLISHED,
    ]);

    expect($post->is_published)->toBeTrue();
    expect($post->published_at)->not->toBeNull();
});

it('published scope includes published posts and excludes drafts and future schedule', function () {
    $visible = Post::query()->create([
        'title' => 'Widoczny',
        'slug' => 'widoczny',
        'content' => 'widoczny',
        'author' => 'Autor',
        'status' => Post::STATUS_PUBLISHED,
        'published_at' => now()->subMinute(),
    ]);

    Post::query()->create([
        'title' => 'Szkic',
        'slug' => 'szkic',
        'content' => 'szkic',
        'author' => 'Autor',
        'status' => Post::STATUS_DRAFT,
    ]);

    Post::query()->create([
        'title' => 'Zaplanowany',
        'slug' => 'zaplanowany',
        'content' => 'zaplanowany',
        'author' => 'Autor',
        'status' => Post::STATUS_SCHEDULED,
        'published_at' => now()->addHour(),
    ]);

    $publishedIds = Post::query()->published()->pluck('id')->all();

    expect($publishedIds)->toContain($visible->id);
    expect($publishedIds)->toHaveCount(1);
});

it('belongs to category relation works', function () {
    $category = Category::query()->create(['name' => 'Rehabilitacja']);

    $post = Post::query()->create([
        'category_id' => $category->id,
        'title' => 'Post z kategoria',
        'slug' => 'post-z-kategoria',
        'content' => 'Tresc',
        'author' => 'Autor',
        'status' => Post::STATUS_DRAFT,
    ]);

    expect($post->category)->not->toBeNull();
    expect($post->category?->name)->toBe('Rehabilitacja');
});
