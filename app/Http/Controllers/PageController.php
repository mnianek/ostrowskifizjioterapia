<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Video;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function youtube()
    {
        $videos = Video::query()
            ->latest()
            ->get()
            ->map(function (Video $video) {
                $video->embed_url = $this->youtubeUrlToEmbed($video->url);

                return $video;
            });

        return view('pages.youtube', [
            'videos' => $videos,
        ]);
    }

    public function contact()
    {
        $locations = Location::query()
            ->latest()
            ->get();

        return view('pages.contact', [
            'locations' => $locations,
        ]);
    }

    private function youtubeUrlToEmbed(string $url): ?string
    {
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        $parts = parse_url($url);
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
