<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'description',
    ];

    public function getEmbedUrlAttribute(): ?string
    {
        if (str_contains($this->url, 'youtube.com/embed/')) {
            return $this->url;
        }

        $parts = parse_url($this->url);
        $host = $parts['host'] ?? '';

        if ($host === 'youtu.be') {
            $videoId = trim($parts['path'] ?? '', '/');

            return $videoId !== '' ? "https://www.youtube.com/embed/{$videoId}" : null;
        }

        if (str_contains($host, 'youtube.com')) {
            parse_str($parts['query'] ?? '', $query);

            if (! empty($query['v'])) {
                return 'https://www.youtube.com/embed/' . $query['v'];
            }
        }

        return null;
    }
}
