<?php

use App\Services\ActivityLogRetentionService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('activity-logs:archive-prune {--days= : Retention period in days}', function (ActivityLogRetentionService $service): void {
    $daysOption = $this->option('days');
    $retentionDays = is_numeric($daysOption) ? max(1, (int) $daysOption) : (int) config('audit.retention_days', 180);

    $archived = $service->archiveAndPrune($retentionDays);

    $this->info("Archived and pruned {$archived} activity logs older than {$retentionDays} days.");
})->purpose('Archive and delete old entries from activity_logs according to retention policy.');

Schedule::command('activity-logs:archive-prune')->dailyAt('02:30');
