<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterSubscriberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebVitalsController;
use App\Models\Post;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/og/posts/{slug}.svg', [PostController::class, 'ogImage'])->name('posts.og-image');
Route::get('/feed', [PostController::class, 'feed'])->name('posts.feed');
Route::post('/blog/{slug}/comments', [PostController::class, 'storeComment'])
    ->middleware('throttle:8,1')
    ->name('posts.comments.store');

Route::get('/sitemap.xml', function () {
    $posts = Post::query()
        ->published()
        ->latest('published_at')
        ->get(['slug', 'updated_at', 'published_at']);

    return response()
        ->view('sitemap', ['posts' => $posts])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/o-mnie', [PageController::class, 'about'])->name('pages.about');
Route::get('/youtube', [PageController::class, 'youtube'])->name('pages.youtube');
Route::get('/polityka-prywatnosci', [PageController::class, 'privacyPolicy'])->name('pages.privacy-policy');
Route::get('/cookies', [PageController::class, 'cookies'])->name('pages.cookies');
Route::get('/regulamin', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/go/youtube-channel', [AnalyticsController::class, 'youtubeChannel'])->name('analytics.youtube-channel');
Route::get('/kontakt', [ContactController::class, 'index'])->name('pages.contact');
Route::post('/kontakt', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

Route::post('/newsletter', [NewsletterSubscriberController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('newsletter.subscribe');

Route::post('/web-vitals', [WebVitalsController::class, 'store'])
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->middleware('throttle:30,1')
    ->name('web-vitals.store');

Route::get('/hello-world/{name}', [HelloController::class, 'index']);
