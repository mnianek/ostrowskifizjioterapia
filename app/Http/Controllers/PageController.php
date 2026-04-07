<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Video;
use App\Models\YoutubePageSetting;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function youtube()
    {
        $settings = YoutubePageSetting::current();

        $videos = Video::query()
            ->latest()
            ->get();

        return view('pages.youtube', [
            'settings' => $settings,
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
}
