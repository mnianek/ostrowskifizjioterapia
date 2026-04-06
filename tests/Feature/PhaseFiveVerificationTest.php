<?php

use App\Models\Category;
use App\Models\Location;
use App\Models\SiteStat;
use App\Models\Post;
use App\Filament\Widgets\StatsOverview;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders all key public pages and navigation links', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('name="viewport"', false);
    $response->assertSee(route('home'));
    $response->assertSee(route('posts.index'));
    $response->assertSee(route('pages.about'));
    $response->assertSee(route('pages.youtube'));
    $response->assertSee(route('pages.contact'));

    $this->get(route('posts.index'))->assertOk();
    $this->get(route('pages.about'))->assertOk();
    $this->get(route('pages.youtube'))->assertOk();
    $this->get(route('pages.contact'))->assertOk();
});

it('tracks unique sessions only once per browser session', function () {
    $this->get(route('home'))->assertOk();

    expect(SiteStat::query()->where('key', 'unique_visits')->value('value'))->toBe(1);

    $this->get(route('home'))->assertOk();

    expect(SiteStat::query()->where('key', 'unique_visits')->value('value'))->toBe(1);
});

it('shows post list, details, and supports filtering by category', function () {
    $rehab = Category::create(['name' => 'Rehabilitacja']);
    $sport = Category::create(['name' => 'Sport']);

    $targetPost = Post::create([
        'category_id' => $rehab->id,
        'title' => 'Powrot po urazie',
        'slug' => 'powrot-po-urazie',
        'lead' => 'Plan rehabilitacji',
        'excerpt' => 'Krotki opis wpisu',
        'content' => 'Tresc artykulu.',
        'author' => 'Jan',
        'status' => 'published',
        'published_at' => now(),
    ]);

    Post::create([
        'category_id' => $sport->id,
        'title' => 'Trening biegacza',
        'slug' => 'trening-biegacza',
        'lead' => 'Profilaktyka urazow',
        'excerpt' => 'Opis',
        'content' => 'Inna tresc.',
        'author' => 'Anna',
        'status' => 'draft',
    ]);

    $this->get(route('posts.index'))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertSee('Trening biegacza');

    $this->get(route('posts.index', ['category' => $rehab->id]))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertDontSee('Trening biegacza');

    $this->get(route('posts.show', $targetPost->slug))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertSee('Tresc artykulu.', false);

    expect($targetPost->refresh()->views_count)->toBe(1);

    $this->get(route('posts.show', $targetPost->slug))->assertOk();

    expect($targetPost->refresh()->views_count)->toBe(1);
});

it('renders youtube embeds from stored video urls', function () {
    Video::create([
        'title' => 'Mobilizacja barku',
        'url' => 'https://www.youtube.com/watch?v=abc123xyz45',
        'description' => 'Material edukacyjny',
    ]);

    $this->get(route('pages.youtube'))
        ->assertOk()
        ->assertSee('https://www.youtube.com/embed/abc123xyz45');
});

it('renders locations and map iframes on contact page', function () {
    Location::create([
        'name' => 'Gabinet Centrum',
        'address' => 'ul. Zdrowa 10',
        'map_link' => 'https://maps.google.com/maps?q=krakow&t=&z=13&ie=UTF8&iwloc=&output=embed',
        'hours' => "Pon-Pt 8:00-18:00\nSob 9:00-13:00",
    ]);

    $this->get(route('pages.contact'))
        ->assertOk()
        ->assertSee('Gabinet Centrum')
        ->assertSee('output=embed');
});

it('allows authenticated access to basic filament resource pages', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Manualna']);
    $video = Video::create([
        'title' => 'Oddech przeponowy',
        'url' => 'https://youtu.be/abc123xyz45',
        'description' => 'Opis',
    ]);
    $location = Location::create([
        'name' => 'Gabinet Polnoc',
        'address' => 'ul. Sprawnosci 5',
        'map_link' => 'https://maps.google.com/maps?q=poznan&output=embed',
        'hours' => 'Pon-Pt 9:00-17:00',
    ]);
    $post = Post::create([
        'category_id' => $category->id,
        'title' => 'Post testowy',
        'slug' => 'post-testowy',
        'content' => 'Test',
        'author' => 'Tester',
        'status' => 'draft',
    ]);

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/posts')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/categories')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/videos')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/locations')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/posts/' . $post->id . '/edit')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/categories/' . $category->id . '/edit')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/videos/' . $video->id . '/edit')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/locations/' . $location->id . '/edit')
        ->assertOk();
});

it('exposes unique patients and pending comments stats on the dashboard widget', function () {
    SiteStat::create([
        'key' => 'unique_visits',
        'value' => 7,
    ]);

    $widget = app(StatsOverview::class);
    $reflection = new \ReflectionClass($widget);
    $method = $reflection->getMethod('getStats');
    $method->setAccessible(true);

    $stats = $method->invoke($widget);

    expect($stats)->toHaveCount(2);
    expect($stats[0]->getLabel())->toBe('Unikalni Pacjenci');
    expect($stats[0]->getValue())->toBe('7');
    expect($stats[1]->getLabel())->toBe('Komentarze do zatwierdzenia');
    expect($stats[1]->getValue())->toBe('0');
});

it('does not count admin visits toward unique sessions', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk();

    expect(SiteStat::query()->where('key', 'unique_visits')->value('value') ?? 0)->toBe(0);
});
