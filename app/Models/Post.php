<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    public const STATUS_SCHEDULED = 'scheduled';

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
        'author_id',
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
        'author_id' => 'integer',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Post $post): void {
            if (blank($post->slug) && filled($post->title)) {
                $post->slug = Str::slug((string) $post->title);
            }

            if (blank($post->excerpt) && filled($post->content)) {
                $post->excerpt = Str::limit(strip_tags((string) $post->content), 160);
            }

            $status = $post->status ?: self::STATUS_DRAFT;

            if ($status === self::STATUS_DRAFT) {
                $post->is_published = false;
                $post->published_at = null;

                return;
            }

            $post->is_published = in_array($status, [self::STATUS_PUBLISHED, self::STATUS_SCHEDULED], true);

            if ($status === self::STATUS_PUBLISHED && ! $post->published_at) {
                $post->published_at = now();
            }
        });
    }

    public function setStatusAttribute(string $value): void
    {
        $allowedStatuses = [self::STATUS_DRAFT, self::STATUS_PUBLISHED, self::STATUS_SCHEDULED];

        $status = in_array($value, $allowedStatuses, true) ? $value : self::STATUS_DRAFT;

        $this->attributes['status'] = $status;
    }

    public function setSlugAttribute(string $value): void
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $publishedQuery): void {
                $publishedQuery
                    ->where(function (Builder $datedQuery): void {
                        $datedQuery
                            ->whereNotNull('published_at')
                            ->where('published_at', '<=', now());
                    })
                    ->orWhere(function (Builder $legacyPublishedQuery): void {
                        $legacyPublishedQuery
                            ->whereNull('published_at')
                            ->where('status', self::STATUS_PUBLISHED);
                    });
            });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function pinnedComment(): HasOne
    {
        return $this->hasOne(Comment::class)->where('is_pinned', true);
    }

    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
