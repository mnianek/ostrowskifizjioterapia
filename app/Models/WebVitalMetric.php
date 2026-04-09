<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebVitalMetric extends Model
{
    protected $fillable = [
        'metric',
        'value',
        'rating',
        'path',
        'session_token',
        'user_agent',
    ];

    protected $casts = [
        'value' => 'float',
    ];
}
