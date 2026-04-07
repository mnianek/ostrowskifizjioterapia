<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $fillable = [
        'email',
        'privacy_consent',
        'privacy_consent_at',
        'privacy_consent_ip',
    ];
}
