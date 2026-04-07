<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $appends = [
        'reading_time',
    ];

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'lead',
        'excerpt',
        'content',
        'author',
        'photo',
        'image_path',
        'is_published',
        'status',
        'published_at',
        'views_count',
    ];

    protected $attributes = [
        'status' => 'draft',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function setStatusAttribute(string $value): void
    {
        $this->attributes['status'] = $value;
        $this->attributes['is_published'] = $value === 'published';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getReadingTimeAttribute(): int
    {
        return (int) ceil(str_word_count(strip_tags((string) $this->content)) / 200);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('featured_image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(480)
            ->height(320)
            ->sharpen(10)
            ->performOnCollections('featured_image');
    }
}
