<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
        'privacy_consent',
        'privacy_consent_at',
        'privacy_consent_ip',
    ];
}
