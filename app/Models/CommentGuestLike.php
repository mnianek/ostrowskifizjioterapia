<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentGuestLike extends Model
{
    use HasFactory;

    protected $table = 'comment_guest_like';

    protected $fillable = [
        'comment_id',
        'guest_token',
    ];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
