<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::query()
            ->with('category')
            ->where('is_published', true)
            ->latest('published_at')
            ->latest('created_at')
            ->limit(3)
            ->get();

        return view('pages.home', [
            'latestPosts' => $latestPosts,
        ]);
    }
}
