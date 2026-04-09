<?php

return [
    'retention_days' => (int) env('AUDIT_LOG_RETENTION_DAYS', 180),
    'archive_batch_size' => (int) env('AUDIT_LOG_ARCHIVE_BATCH_SIZE', 500),
];
