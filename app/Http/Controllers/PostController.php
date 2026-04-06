<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $selectedCategory = request()->integer('category');

        $posts = Post::query()
            ->with('category')
            ->when($selectedCategory, function ($query, int $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest('published_at')
            ->latest('created_at')
            ->paginate(9);

        $categories = Category::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->with([
                'comments' => fn ($query) => $query
                    ->where('is_approved', true)
                    ->latest(),
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $viewedPosts = session()->get('viewed_posts', []);

        if (! in_array($post->id, $viewedPosts, true)) {
            $post->increment('views_count');

            $viewedPosts[] = $post->id;
            session()->put('viewed_posts', $viewedPosts);
        }

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function storeComment(Request $request, string $slug)
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $parameters = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:5000'],
        ]);

        $post->comments()->create([
            'user_name' => $parameters['user_name'],
            'content' => $parameters['content'],
            'is_approved' => false,
        ]);

        return redirect()
            ->route('posts.show', $post->slug)
            ->with('comment_status', 'Twój komentarz oczekuje na zatwierdzenie przez administratora');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $parameters = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
            'lead' => ['nullable', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $post = new Post;

        $post->title = $parameters['title'];
        $post->slug = $parameters['slug'];
        $post->lead = $parameters['lead'] ?? null;
        $post->author = $parameters['author'];
        $post->content = $parameters['content'];

        // Post::create($parameters);

        $post->save();

        return redirect()->route('posts.index');
    }
}
