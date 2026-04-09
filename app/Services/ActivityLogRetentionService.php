<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\ActivityLogArchive;
use Illuminate\Support\Facades\DB;

class ActivityLogRetentionService
{
    public function archiveAndPrune(?int $retentionDays = null): int
    {
        $days = $retentionDays ?? (int) config('audit.retention_days', 180);
        $batchSize = (int) config('audit.archive_batch_size', 500);
        $cutoff = now()->subDays($days);
        $archivedCount = 0;

        ActivityLog::query()
            ->where('created_at', '<', $cutoff)
            ->orderBy('id')
            ->chunkById($batchSize, function ($logs) use (&$archivedCount): void {
                $rows = $logs->map(function (ActivityLog $log): array {
                    return [
                        'original_id' => $log->id,
                        'causer_id' => $log->causer_id,
                        'subject_type' => (string) $log->subject_type,
                        'subject_id' => (int) $log->subject_id,
                        'action' => (string) $log->action,
                        'properties' => $log->properties ? json_encode($log->properties, JSON_THROW_ON_ERROR) : null,
                        'ip_address' => $log->ip_address,
                        'user_agent' => $log->user_agent,
                        'archived_at' => now(),
                        'created_at' => $log->created_at,
                        'updated_at' => $log->updated_at,
                    ];
                })->values()->all();

                $ids = $logs->pluck('id')->all();

                DB::transaction(function () use ($rows, $ids, &$archivedCount): void {
                    ActivityLogArchive::query()->upsert(
                        $rows,
                        ['original_id'],
                        ['causer_id', 'subject_type', 'subject_id', 'action', 'properties', 'ip_address', 'user_agent', 'archived_at', 'created_at', 'updated_at']
                    );

                    $archivedCount += count($rows);

                    ActivityLog::query()->whereIn('id', $ids)->delete();
                });
            });

        return $archivedCount;
    }
}
