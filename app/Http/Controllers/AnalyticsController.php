<?php

namespace App\Http\Controllers;

use App\Models\YoutubePageSetting;
use App\Services\AnalyticsService;
use Illuminate\Http\RedirectResponse;

class AnalyticsController extends Controller
{
    public function youtubeChannel(AnalyticsService $analytics): RedirectResponse
    {
        $analytics->increment('cta_youtube_channel_clicks');

        return redirect()->away(YoutubePageSetting::current()->channel_url);
    }
}
