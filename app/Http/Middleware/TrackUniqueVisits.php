<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUniqueVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin*') || $request->is('livewire/*')) {
            return $next($request);
        }

        $analytics = app(AnalyticsService::class);

        if (! $request->session()->has('site_visited')) {
            $analytics->increment('unique_visits');

            $sourceKey = $analytics->sourceKey(
                $request->query('utm_source'),
                $request->headers->get('referer'),
            );

            $analytics->increment($sourceKey);

            $request->session()->put('site_visited', true);
        }

        return $next($request);
    }
}
