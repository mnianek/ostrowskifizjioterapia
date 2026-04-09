<?php

use App\Models\ActivityLog;
use App\Models\ActivityLogArchive;
use App\Services\ActivityLogRetentionService;
use Illuminate\Support\Facades\DB;

it('archives and prunes activity logs older than retention period', function () {
    $oldLogId = DB::table('activity_logs')->insertGetId([
        'causer_id' => null,
        'subject_type' => App\Models\Post::class,
        'subject_id' => 100,
        'action' => 'updated',
        'properties' => json_encode(['field' => 'title']),
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Pest',
        'created_at' => now()->subDays(365),
        'updated_at' => now()->subDays(365),
    ]);

    $newLogId = DB::table('activity_logs')->insertGetId([
        'causer_id' => null,
        'subject_type' => App\Models\Post::class,
        'subject_id' => 101,
        'action' => 'created',
        'properties' => json_encode(['field' => 'content']),
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Pest',
        'created_at' => now()->subDays(7),
        'updated_at' => now()->subDays(7),
    ]);

    $archivedCount = app(ActivityLogRetentionService::class)->archiveAndPrune(180);

    expect($archivedCount)->toBe(1);

    expect(ActivityLog::query()->whereKey($oldLogId)->exists())->toBeFalse();
    expect(ActivityLog::query()->whereKey($newLogId)->exists())->toBeTrue();

    $archiveEntry = ActivityLogArchive::query()->where('original_id', $oldLogId)->first();

    expect($archiveEntry)->not->toBeNull();
    expect($archiveEntry?->action)->toBe('updated');
    expect($archiveEntry?->subject_id)->toBe(100);
});
