<?php

use App\Models\WebVitalMetric;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('stores valid core web vitals metrics', function () {
    $response = postJson(route('web-vitals.store'), [
        'path' => '/blog/test-wpis?search=abc',
        'session_token' => 'session-abc-123',
        'metrics' => [
            ['name' => 'LCP', 'value' => 2123.4, 'rating' => 'good'],
            ['name' => 'CLS', 'value' => 0.04, 'rating' => 'good'],
            ['name' => 'INP', 'value' => 175, 'rating' => 'needs-improvement'],
        ],
    ]);

    $response->assertOk()->assertJson(['status' => 'ok']);

    expect(WebVitalMetric::query()->count())->toBe(3);

    expect(WebVitalMetric::query()->where('metric', 'LCP')->first())
        ->not->toBeNull()
        ->path->toBe('/blog/test-wpis?search=abc');
});

it('skips invalid metrics while persisting valid ones', function () {
    $response = postJson(route('web-vitals.store'), [
        'path' => '/blog',
        'session_token' => 'session-mix-123',
        'metrics' => [
            ['name' => 'LCP', 'value' => 1400, 'rating' => 'good'],
            ['name' => 'TTFB', 'value' => 100, 'rating' => 'good'],
            ['name' => 'CLS', 'value' => 'invalid', 'rating' => 'poor'],
        ],
    ]);

    $response->assertOk();

    expect(WebVitalMetric::query()->count())->toBe(1);
    expect(WebVitalMetric::query()->first()?->metric)->toBe('LCP');
});

it('returns 422 for invalid payload body', function () {
    $response = $this->call(
        'POST',
        route('web-vitals.store'),
        [],
        [],
        [],
        ['CONTENT_TYPE' => 'application/json'],
        '{"metrics":}',
    );

    $response->assertStatus(422);
    expect(WebVitalMetric::query()->count())->toBe(0);
});
