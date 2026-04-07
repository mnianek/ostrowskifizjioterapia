<?php

use App\Models\Faq;
use App\Models\Location;
use App\Models\NewsletterSubscriber;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('stores contact messages from the contact form', function () {
    Location::create([
        'name' => 'Gabinet Główny',
        'city' => 'Wrocław',
        'address' => 'ul. Testowa 1',
        'map_link' => 'https://example.com/map',
        'hours' => 'Pon-Pt 8:00-16:00',
    ]);

    $response = post(route('contact.store'), [
        'name' => 'Jan Kowalski',
        'email' => 'jan@example.com',
        'phone' => '123 456 789',
        'content' => 'Chciałbym umówić wizytę.',
    ]);

    $response->assertRedirect(route('pages.contact'));

    assertDatabaseHas('messages', [
        'name' => 'Jan Kowalski',
        'email' => 'jan@example.com',
    ]);
});

it('stores newsletter subscribers from the footer form', function () {
    $response = post(route('newsletter.subscribe'), [
        'email' => 'subskrybent@example.com',
    ]);

    $response->assertRedirect();

    assertDatabaseHas('newsletter_subscribers', [
        'email' => 'subskrybent@example.com',
    ]);

    expect(NewsletterSubscriber::query()->count())->toBe(1);
});

it('renders active faq entries on the home page', function () {
    Faq::create([
        'question' => 'Czy potrzebuję skierowania?',
        'answer' => 'Nie, możesz zapisać się bez skierowania.',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    Faq::create([
        'question' => 'Ukryte pytanie',
        'answer' => 'To pytanie nie powinno być widoczne.',
        'is_active' => false,
        'sort_order' => 2,
    ]);

    get(route('home'))
        ->assertOk()
        ->assertSee('Czy potrzebuję skierowania?')
        ->assertDontSee('Ukryte pytanie');
});
