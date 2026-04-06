<?php

namespace App\Http\Middleware;

use App\Models\SiteStat;
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

        if (! $request->session()->has('site_visited')) {
            SiteStat::query()->firstOrCreate(
                ['key' => 'unique_visits'],
                ['value' => 0],
            )->increment('value');

            $request->session()->put('site_visited', true);
        }

        return $next($request);
    }
}
