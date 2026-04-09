<?php

use App\Services\ActivityLogRetentionService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;
use Symfony\Component\Console\Command\Command;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('activity-logs:archive-prune {--days= : Retention period in days}', function (ActivityLogRetentionService $service): void {
    $daysOption = $this->option('days');
    $retentionDays = is_numeric($daysOption) ? max(1, (int) $daysOption) : (int) config('audit.retention_days', 180);

    $archived = $service->archiveAndPrune($retentionDays);

    $this->info("Archived and pruned {$archived} activity logs older than {$retentionDays} days.");
})->purpose('Archive and delete old entries from activity_logs according to retention policy.');

Artisan::command('backup:verify-latest', function (): int {
    $backupDirectory = storage_path('app/private/'.config('backup.backup.name'));

    if (! File::exists($backupDirectory)) {
        $this->error('Backup directory does not exist yet: '.$backupDirectory);

        return Command::FAILURE;
    }

    $latestArchive = collect(File::files($backupDirectory))
        ->filter(fn (SplFileInfo $file): bool => str_ends_with($file->getFilename(), '.zip'))
        ->sortByDesc(fn (SplFileInfo $file): int => $file->getMTime())
        ->first();

    if (! $latestArchive) {
        $this->error('No backup archive found in '.$backupDirectory);

        return Command::FAILURE;
    }

    $zip = new ZipArchive;
    $opened = $zip->open($latestArchive->getPathname());

    if ($opened !== true) {
        $this->error('Cannot open backup archive: '.$latestArchive->getFilename());

        return Command::FAILURE;
    }

    $hasDbDump = false;

    for ($index = 0; $index < $zip->numFiles; $index++) {
        $entry = $zip->getNameIndex($index);

        if (is_string($entry) && preg_match('/\.sql(\.gz)?$/', $entry) === 1) {
            $hasDbDump = true;
            break;
        }
    }

    $zip->close();

    if (! $hasDbDump) {
        $this->error('Latest backup archive does not contain a database dump.');

        return Command::FAILURE;
    }

    $this->info('Latest backup archive can be opened and contains a database dump.');

    return Command::SUCCESS;
})->purpose('Verify that the latest backup archive is readable and includes a database dump.');

Schedule::command('activity-logs:archive-prune')->dailyAt('02:30');
Schedule::command('backup:run --only-db --disable-notifications')->dailyAt('02:45');
Schedule::command('backup:run --only-files --disable-notifications')->dailyAt('03:00');
Schedule::command('backup:clean')->dailyAt('03:20');
Schedule::command('backup:monitor')->dailyAt('03:30');
