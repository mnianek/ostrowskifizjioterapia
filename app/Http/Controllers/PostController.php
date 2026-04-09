<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function ogImage(string $slug): Response
    {
        $post = Post::query()
            ->published()
            ->with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $title = e(str($post->title)->limit(72)->toString());
        $category = e($post->category?->name ?? 'Blog');
        $appName = e((string) config('app.name'));

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="630" viewBox="0 0 1200 630" role="img" aria-label="{$title}">
    <defs>
        <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#1a1a1a"/>
            <stop offset="100%" stop-color="#3b4d41"/>
        </linearGradient>
    </defs>
    <rect width="1200" height="630" fill="url(#bg)"/>
    <rect x="56" y="56" width="1088" height="518" rx="28" fill="rgba(249,247,242,0.08)" stroke="rgba(249,247,242,0.25)"/>
    <text x="96" y="170" fill="#f9f7f2" font-family="Inter, Arial, sans-serif" font-size="28" font-weight="700" letter-spacing="2">{$category}</text>
    <foreignObject x="96" y="210" width="1008" height="260">
        <div xmlns="http://www.w3.org/1999/xhtml" style="font-family: Inter, Arial, sans-serif; font-size: 62px; line-height: 1.1; color: #f9f7f2; font-weight: 700;">
            {$title}
        </div>
    </foreignObject>
    <text x="96" y="536" fill="rgba(249,247,242,0.85)" font-family="Inter, Arial, sans-serif" font-size="24">{$appName}</text>
</svg>
SVG;

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
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
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:posts,slug'],
            'lead' => ['nullable', 'string', 'max:500'],
            'author' => ['required', 'string', 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:50'],
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
