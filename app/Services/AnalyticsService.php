<?php

namespace App\Services;

use App\Models\SiteStat;

class AnalyticsService
{
    public function increment(string $key, int $by = 1): void
    {
        SiteStat::query()->firstOrCreate(
            ['key' => $key],
            ['value' => 0],
        )->increment('value', $by);
    }

    public function sourceKey(?string $utmSource, ?string $referer): string
    {
        $source = strtolower(trim((string) ($utmSource ?: '')));

        if ($source !== '') {
            return 'source:'.$this->normalizeSource($source);
        }

        $host = parse_url((string) $referer, PHP_URL_HOST);
        $host = strtolower((string) $host);

        if ($host === '') {
            return 'source:direct';
        }

        return 'source:'.$this->normalizeSource($host);
    }

    private function normalizeSource(string $source): string
    {
        if (str_contains($source, 'google')) {
            return 'google';
        }

        if (str_contains($source, 'facebook')) {
            return 'facebook';
        }

        if (str_contains($source, 'instagram')) {
            return 'instagram';
        }

        if (str_contains($source, 'youtube')) {
            return 'youtube';
        }

        if (str_contains($source, 'linkedin')) {
            return 'linkedin';
        }

        if (str_contains($source, 'bing')) {
            return 'bing';
        }

        if (str_contains($source, 'duckduckgo')) {
            return 'duckduckgo';
        }

        if (str_contains($source, 't.co') || str_contains($source, 'twitter') || str_contains($source, 'x.com')) {
            return 'x';
        }

        return 'other';
    }
}
