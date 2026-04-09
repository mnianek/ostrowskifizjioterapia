<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLogArchive extends Model
{
    protected $fillable = [
        'original_id',
        'causer_id',
        'subject_type',
        'subject_id',
        'action',
        'properties',
        'ip_address',
        'user_agent',
        'archived_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'properties' => 'array',
        'archived_at' => 'datetime',
    ];

    public function causer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
