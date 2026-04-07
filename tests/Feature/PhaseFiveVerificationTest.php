<?php

use App\Filament\Widgets\StatsOverview;
use App\Models\Category;
use App\Models\Location;
use App\Models\Post;
use App\Models\SiteStat;
use App\Models\User;
use App\Models\Video;
use App\Models\YoutubePageSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('renders all key public pages and navigation links', function () {
    $response = get(route('home'));

    $response->assertOk();
    $response->assertSee('name="viewport"', false);
    $response->assertSee(route('home'));
    $response->assertSee(route('posts.index'));
    $response->assertSee(route('pages.about'));
    $response->assertSee(route('pages.youtube'));
    $response->assertSee(route('pages.contact'));

    get(route('posts.index'))->assertOk();
    get(route('pages.about'))->assertOk();
    get(route('pages.youtube'))->assertOk();
    get(route('pages.contact'))->assertOk();
});

it('tracks unique sessions only once per browser session', function () {
    get(route('home'))->assertOk();

    expect(SiteStat::query()->where('key', 'unique_visits')->value('value'))->toBe(1);

    get(route('home'))->assertOk();

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

    get(route('posts.index'))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertDontSee('Trening biegacza');

    get(route('posts.index', ['category' => $rehab->id]))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertDontSee('Trening biegacza');

    get(route('posts.show', $targetPost->slug))
        ->assertOk()
        ->assertSee('Powrot po urazie')
        ->assertSee('Tresc artykulu.', false);

    expect($targetPost->refresh()->views_count)->toBe(1);

    get(route('posts.show', $targetPost->slug))->assertOk();

    expect($targetPost->refresh()->views_count)->toBe(1);
});

it('shows reading time and supports search and sort modes', function () {
    $category = Category::create(['name' => 'Edukacja']);

    $shortPost = Post::create([
        'category_id' => $category->id,
        'title' => 'Krotki wpis',
        'slug' => 'krotki-wpis',
        'content' => str_repeat('slowo ', 50),
        'author' => 'Anna',
        'status' => 'published',
        'published_at' => now()->subDay(),
        'views_count' => 5,
    ]);

    $popularPost = Post::create([
        'category_id' => $category->id,
        'title' => 'Popularny wpis',
        'slug' => 'popularny-wpis',
        'content' => str_repeat('slowo ', 420),
        'author' => 'Anna',
        'status' => 'published',
        'published_at' => now(),
        'views_count' => 42,
    ]);

    $commentedPost = Post::create([
        'category_id' => $category->id,
        'title' => 'Komentowany wpis',
        'slug' => 'komentowany-wpis',
        'content' => str_repeat('slowo ', 220),
        'author' => 'Anna',
        'status' => 'published',
        'published_at' => now()->subHours(2),
        'views_count' => 8,
    ]);

    $popularPost->comments()->create([
        'user_name' => 'Jan',
        'content' => 'Komentarz 1',
        'is_approved' => true,
    ]);
    $popularPost->comments()->create([
        'user_name' => 'Ewa',
        'content' => 'Komentarz 2',
        'is_approved' => true,
    ]);
    $commentedPost->comments()->create([
        'user_name' => 'Piotr',
        'content' => 'Komentarz 3',
        'is_approved' => true,
    ]);
    $commentedPost->comments()->create([
        'user_name' => 'Ola',
        'content' => 'Komentarz 4',
        'is_approved' => true,
    ]);
    $commentedPost->comments()->create([
        'user_name' => 'Marek',
        'content' => 'Komentarz 5',
        'is_approved' => true,
    ]);

    get(route('posts.index', ['search' => 'Popularny']))
        ->assertOk()
        ->assertSee('Popularny wpis')
        ->assertDontSee('Krotki wpis');

    get(route('posts.index', ['sort' => 'popular']))
        ->assertOk()
        ->assertSeeInOrder(['Popularny wpis', 'Komentowany wpis', 'Krotki wpis']);

    get(route('posts.index', ['sort' => 'popular', 'direction' => 'asc']))
        ->assertOk()
        ->assertSeeInOrder(['Krotki wpis', 'Komentowany wpis', 'Popularny wpis']);

    get(route('posts.index', ['sort' => 'comments']))
        ->assertOk()
        ->assertSeeInOrder(['Komentowany wpis', 'Popularny wpis', 'Krotki wpis']);

    get(route('posts.index', ['sort' => 'comments', 'direction' => 'asc']))
        ->assertOk()
        ->assertSeeInOrder(['Krotki wpis', 'Popularny wpis', 'Komentowany wpis']);

    expect($shortPost->refresh()->reading_time)->toBe(1);
    expect($popularPost->refresh()->reading_time)->toBe(3);
    expect($commentedPost->refresh()->reading_time)->toBe(2);
});

it('renders youtube embeds from stored video urls', function () {
    YoutubePageSetting::create(YoutubePageSetting::defaults());

    Video::create([
        'title' => 'Mobilizacja barku',
        'url' => 'https://www.youtube.com/watch?v=abc123xyz45',
        'description' => 'Material edukacyjny',
    ]);

    get(route('pages.youtube'))
        ->assertOk()
        ->assertSee('Filmy na YouTube')
        ->assertSee('Otwórz kanał')
        ->assertSee('https://www.youtube.com/embed/abc123xyz45');
});

it('renders locations and map iframes on contact page', function () {
    Location::create([
        'name' => 'Gabinet Centrum',
        'address' => 'ul. Zdrowa 10',
        'map_link' => 'https://maps.google.com/maps?q=krakow&t=&z=13&ie=UTF8&iwloc=&output=embed',
        'hours' => "Pon-Pt 8:00-18:00\nSob 9:00-13:00",
    ]);

    get(route('pages.contact'))
        ->assertOk()
        ->assertSee('Gabinet Centrum')
        ->assertSee('output=embed');
});

it('allows authenticated access to basic filament resource pages', function () {
    $role = Role::query()->firstOrCreate(['name' => 'super_admin']);

    collect(['Post', 'Category', 'Video', 'Location', 'Faq'])->each(function (string $resource) use ($role): void {
        collect([
            'ViewAny',
            'View',
            'Create',
            'Update',
            'Delete',
            'DeleteAny',
            'Restore',
            'RestoreAny',
            'ForceDelete',
            'ForceDeleteAny',
            'Replicate',
            'Reorder',
        ])->each(function (string $action) use ($resource, $role): void {
            $permission = Permission::query()->firstOrCreate([
                'name' => $action.':'.$resource,
                'guard_name' => 'web',
            ]);

            $role->givePermissionTo($permission);
        });
    });

    $user = User::factory()->create();
    $user->assignRole('super_admin');

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

    actingAs($user)
        ->get('/admin')
        ->assertOk();

    actingAs($user)
        ->get('/admin/posts')
        ->assertOk();

    actingAs($user)
        ->get('/admin/categories')
        ->assertOk();

    actingAs($user)
        ->get('/admin/videos')
        ->assertOk();

    actingAs($user)
        ->get('/admin/locations')
        ->assertOk();

    actingAs($user)
        ->get('/admin/faqs')
        ->assertOk();

    actingAs($user)
        ->get('/admin/faqs/create')
        ->assertOk();

    actingAs($user)
        ->get('/admin/posts/'.$post->id.'/edit')
        ->assertOk();

    actingAs($user)
        ->get('/admin/categories/'.$category->id.'/edit')
        ->assertOk();

    actingAs($user)
        ->get('/admin/videos/'.$video->id.'/edit')
        ->assertOk();

    actingAs($user)
        ->get('/admin/locations/'.$location->id.'/edit')
        ->assertOk();
});

it('exposes unique patients and pending comments stats on the dashboard widget', function () {
    SiteStat::create([
        'key' => 'unique_visits',
        'value' => 7,
    ]);

    Post::create([
        'category_id' => Category::create(['name' => 'Analiza'])->id,
        'title' => 'Szkic testowy',
        'slug' => 'szkic-testowy',
        'content' => 'Treść szkicu.',
        'author' => 'Test',
        'status' => 'draft',
    ]);

    $widget = app(StatsOverview::class);
    $reflection = new \ReflectionClass($widget);
    $method = $reflection->getMethod('getStats');
    $method->setAccessible(true);

    $stats = $method->invoke($widget);

    expect($stats)->toHaveCount(4);
    expect($stats[0]->getLabel())->toBe('Unikalni Pacjenci');
    expect($stats[0]->getValue())->toBe('7');
    expect($stats[1]->getLabel())->toBe('Opublikowane wpisy');
    expect($stats[2]->getLabel())->toBe('Szkice wpisów');
    expect($stats[2]->getValue())->toBe('1');
    expect($stats[3]->getLabel())->toBe('Komentarze do zatwierdzenia');
    expect($stats[3]->getValue())->toBe('0');
});

it('does not count admin visits toward unique sessions', function () {
    Role::query()->firstOrCreate(['name' => 'panel_user']);

    $user = User::factory()->create();
    $user->assignRole('panel_user');

    actingAs($user)
        ->get('/admin')
        ->assertOk();

    expect(SiteStat::query()->where('key', 'unique_visits')->value('value') ?? 0)->toBe(0);
});
