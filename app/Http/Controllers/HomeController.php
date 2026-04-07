<?php

namespace App\Http\Controllers;

use App\Models\Faq;
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

        $faqs = Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('question')
            ->get();

        return view('pages.home', [
            'latestPosts' => $latestPosts,
            'faqs' => $faqs,
        ]);
    }
}
