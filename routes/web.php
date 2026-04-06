<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/blog/{slug}/comments', [PostController::class, 'storeComment'])->name('posts.comments.store');

Route::get('/o-mnie', [PageController::class, 'about'])->name('pages.about');
Route::get('/youtube', [PageController::class, 'youtube'])->name('pages.youtube');
Route::get('/kontakt', [PageController::class, 'contact'])->name('pages.contact');

Route::get('/hello-world/{name}', [HelloController::class, 'index']);

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
