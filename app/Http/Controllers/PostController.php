<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $selectedCategory = request()->integer('category');
        $search = trim((string) request()->string('search'));
        $sort = request()->string('sort')->toString() ?: 'latest';
        $direction = request()->string('direction')->toString();

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'desc';
        }

        $posts = Post::query()
            ->published()
            ->with('category')
            ->withCount([
                'comments as comments_count' => fn ($query) => $query->where('is_approved', true),
            ])
            ->when($selectedCategory, function ($query, int $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when(filled($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%'.$search.'%')
                        ->orWhere('content', 'like', '%'.$search.'%');
                });
            })
            ->when($sort === 'popular', function ($query) use ($direction) {
                $query->orderBy('views_count', $direction);
            })
            ->when($sort === 'comments', function ($query) use ($direction) {
                $query->orderBy('comments_count', $direction);
            })
            ->when($sort === 'latest', function ($query) use ($direction) {
                $query->orderBy('published_at', $direction)
                    ->orderBy('created_at', $direction);
            }, function ($query) use ($direction) {
                $query->orderBy('published_at', $direction)
                    ->orderBy('created_at', $direction);
            })
            ->paginate(9)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->when($post->category_id, function ($query) use ($post) {
                $query->where('category_id', $post->category_id);
            })
            ->latest('published_at')
            ->limit(3)
            ->get(['id', 'title', 'slug', 'lead', 'excerpt', 'published_at']);

        $viewedPosts = session()->get('viewed_posts', []);

        if (! in_array($post->id, $viewedPosts, true)) {
            $post->increment('views_count');

            $viewedPosts[] = $post->id;
            session()->put('viewed_posts', $viewedPosts);
        }

        return view('posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    public function feed()
    {
        $posts = Post::query()
            ->published()
            ->latest('published_at')
            ->limit(20)
            ->get();

        return response()
            ->view('posts.feed', ['posts' => $posts])
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    public function storeComment(Request $request, string $slug)
    {
        $post = Post::query()
            ->published()
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
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

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
        $post->author_id = Auth::id();
        $post->content = $parameters['content'];

        // Post::create($parameters);

        $post->save();

        return redirect()->route('posts.index');
    }
}
