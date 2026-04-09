<x-layout meta-title="Blog | {{ config('app.name') }}"
    meta-description="Artykuly o fizjoterapii, prewencji urazow i bezpiecznym powrocie do ruchu." :canonical="route('posts.index')">
    <main class="bg-paper text-ink dark:bg-ink dark:text-paper">
        <section class="relative overflow-hidden border-b border-ink/10 dark:border-paper/10">
            <div
                class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_90%_0%,rgba(125,157,133,0.18),transparent_48%)] dark:bg-[radial-gradient(circle_at_90%_0%,rgba(125,157,133,0.12),transparent_50%)]">
            </div>
            <div class="reveal relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">
                    Magazyn medyczny
                </p>
                <h1 class="mt-4 max-w-4xl text-ink dark:text-paper">
                    Baza wiedzy fizjoterapeutycznej
                </h1>
                <p class="lead mt-6 max-w-3xl text-ink/70 dark:text-paper/70">
                    Praktyczne materiały o zdrowiu, ruchu i terapii — aby wracać do sprawności spokojniej, bezpieczniej i
                    bardziej świadomie.
                </p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <form method="GET" action="{{ route('posts.index') }}"
                class="reveal mb-10 rounded-3xl border border-ink/10 bg-paper/70 p-4 shadow-[0_18px_50px_rgba(26,26,26,0.06)] backdrop-blur sm:p-6 dark:border-paper/10 dark:bg-paper/5 dark:shadow-none"
                data-reveal>
                <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_220px_180px_auto] lg:items-end">
                    @if ($selectedCategory)
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif

                    <label class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/55">Szukaj</span>
                        <input type="search" name="search" value="{{ $search }}"
                            placeholder="Szukaj w tytułach i treści..."
                            class="w-full rounded-2xl border border-ink/10 bg-paper/80 px-4 py-3 text-sm text-ink outline-none transition placeholder:text-ink/40 focus:border-sage focus:bg-paper focus:ring-4 focus:ring-sage/20 dark:border-paper/10 dark:bg-paper/5 dark:text-paper dark:placeholder:text-paper/40 dark:focus:border-sage dark:focus:ring-sage/15">
                    </label>

                    <label class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/55">Sortowanie</span>
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full rounded-2xl border border-ink/10 bg-paper/80 px-4 py-3 text-sm text-ink outline-none transition focus:border-sage focus:bg-paper focus:ring-4 focus:ring-sage/20 dark:border-paper/10 dark:bg-paper/5 dark:text-paper dark:focus:border-sage dark:focus:ring-sage/15">
                            <option value="latest" @selected($sort === 'latest')>Najnowsze</option>
                            <option value="popular" @selected($sort === 'popular')>Najpopularniejsze</option>
                            <option value="comments" @selected($sort === 'comments')>Najczęściej komentowane</option>
                        </select>
                    </label>

                    <div class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/55">Kierunek</span>
                        <div
                            class="grid grid-cols-2 rounded-2xl border border-ink/10 bg-paper/60 p-1 dark:border-paper/10 dark:bg-paper/5">
                            <label
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold transition {{ $direction === 'desc' ? 'bg-sage text-paper shadow-sm' : 'text-ink/70 hover:bg-paper dark:text-paper/70 dark:hover:bg-paper/10' }}">
                                <input type="radio" name="direction" value="desc" class="sr-only"
                                    onchange="this.form.submit()" @checked($direction === 'desc')>
                                <x-heroicon-o-bars-arrow-down class="h-5 w-5" />
                                Malejąco
                            </label>
                            <label
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold transition {{ $direction === 'asc' ? 'bg-sage text-paper shadow-sm' : 'text-ink/70 hover:bg-paper dark:text-paper/70 dark:hover:bg-paper/10' }}">
                                <input type="radio" name="direction" value="asc" class="sr-only"
                                    onchange="this.form.submit()" @checked($direction === 'asc')>
                                <x-heroicon-o-bars-arrow-up class="h-5 w-5" />
                                Rosnąco
                            </label>
                        </div>
                    </div>

                    <div class="block lg:self-end">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/55">Akcje</span>
                        <div class="flex flex-wrap gap-3 lg:justify-end">
                            <button type="submit" class="btn-primary h-12.5 whitespace-nowrap">
                                Filtruj
                            </button>
                            <a href="{{ route('posts.index') }}" class="btn-secondary h-12.5 whitespace-nowrap">
                                Wyczyść
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="reveal mb-10 flex flex-wrap items-center gap-3" data-reveal>
                <span
                    class="rounded-full border border-ink/10 bg-paper/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.14em] text-ink/60 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/65">
                    Kategorie
                </span>
                <a href="{{ route('posts.index', array_filter(['search' => $search, 'sort' => $sort, 'direction' => $direction])) }}"
                    class="rounded-full border px-4 py-2 text-sm font-medium transition {{ $selectedCategory ? 'border-ink/10 bg-paper/70 text-ink hover:border-sage/50 dark:border-paper/10 dark:bg-paper/5 dark:text-paper' : 'border-sage/40 bg-sage/10 text-sage-800 dark:border-sage/30 dark:bg-sage/15 dark:text-sage-100' }}">
                    Wszystkie
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('posts.index', array_filter(['category' => $category->id, 'search' => $search, 'sort' => $sort, 'direction' => $direction])) }}"
                        class="rounded-full border px-4 py-2 text-sm font-medium transition {{ (int) $selectedCategory === (int) $category->id ? 'border-sage/40 bg-sage/10 text-sage-800 dark:border-sage/30 dark:bg-sage/15 dark:text-sage-100' : 'border-ink/10 bg-paper/70 text-ink hover:border-sage/50 dark:border-paper/10 dark:bg-paper/5 dark:text-paper' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            @forelse ($posts as $post)
                @php
                    $featuredImageUrl =
                        $post->getFirstMediaUrl('featured_image') ?:
                        ($post->image_path || $post->photo
                            ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                            : null);
                @endphp

                @if ($loop->first)
                    <article class="reveal group mb-10 overflow-hidden rounded-3xl border border-ink/10 bg-paper/70 dark:border-paper/10 dark:bg-paper/5"
                        data-reveal>
                        <div class="grid gap-0 lg:grid-cols-[1.15fr_0.85fr]">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="relative block aspect-[4/3] overflow-hidden bg-paper-200 lg:min-h-[420px] lg:aspect-auto dark:bg-paper/10">
                                @if ($featuredImageUrl)
                                    <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.02]">
                                @else
                                    <div
                                        class="flex h-full min-h-[280px] items-center justify-center bg-linear-to-br from-paper-200 to-paper-400 dark:from-paper/10 dark:to-paper/5">
                                        <x-brand.logo size="h-16" :linked="false" />
                                    </div>
                                @endif
                                <div
                                    class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/40 via-ink/0 to-ink/0 dark:from-ink/60">
                                </div>
                            </a>

                            <div class="flex flex-col justify-center p-8 sm:p-10 lg:p-12">
                                <span
                                    class="inline-flex w-fit rounded-full border border-ink/10 bg-paper/80 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.16em] text-ink/65 dark:border-paper/10 dark:bg-paper/10 dark:text-paper/70">
                                    {{ $post->is_published ? 'Artykuł' : 'Szkic' }}
                                </span>
                                <p
                                    class="mt-4 text-[11px] font-semibold uppercase tracking-[0.2em] text-sage-700 dark:text-sage-200">
                                    {{ $post->category?->name ?? 'Bez kategorii' }}
                                </p>
                                <h2 class="mt-3 text-ink dark:text-paper">
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="transition hover:text-ink/80 dark:hover:text-paper/85">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <div
                                    class="mt-4 flex flex-wrap items-center gap-3 text-sm font-medium text-sage-700 dark:text-sage-200">
                                    <time
                                        datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                                        {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji') }}
                                    </time>
                                    <span class="h-1 w-1 rounded-full bg-sage/70"></span>
                                    <span>{{ $post->reading_time }} min czytania</span>
                                </div>
                                <p class="mt-5 line-clamp-4 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                    {{ $post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 220) }}
                                </p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="btn-quiet mt-8 w-fit">
                                    Czytaj artykuł
                                </a>
                            </div>
                        </div>
                    </article>
                @else
                    @if ($loop->iteration === 2)
                        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @endif

                    <article
                        class="reveal group flex h-full flex-col overflow-hidden rounded-3xl border border-ink/10 bg-paper/70 transition duration-500 hover:-translate-y-1 hover:shadow-[0_28px_80px_rgba(26,26,26,0.12)] dark:border-paper/10 dark:bg-paper/5 dark:hover:shadow-none"
                        data-reveal>
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="relative block aspect-[16/11] overflow-hidden bg-paper-200 dark:bg-paper/10">
                            @if ($featuredImageUrl)
                                <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div
                                    class="flex h-full items-center justify-center bg-linear-to-br from-paper-200 to-paper-400 dark:from-paper/10 dark:to-paper/5">
                                    <x-brand.logo size="h-12" :linked="false" />
                                </div>
                            @endif
                            <div
                                class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/30 via-ink/0 to-ink/0 dark:from-ink/50">
                            </div>
                        </a>

                        <div class="flex flex-1 flex-col p-7">
                            <span
                                class="inline-flex w-fit rounded-full border border-ink/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-ink/60 dark:border-paper/10 dark:text-paper/65">
                                {{ $post->is_published ? 'Artykuł' : 'Szkic' }}
                            </span>
                            <p
                                class="mt-3 text-[11px] font-semibold uppercase tracking-[0.18em] text-sage-700 dark:text-sage-200">
                                {{ $post->category?->name ?? 'Bez kategorii' }}
                            </p>
                            <h3 class="mt-2 flex-1 text-ink dark:text-paper">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="transition hover:text-ink/80 dark:hover:text-paper/85">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <div
                                class="mt-4 flex flex-wrap items-center gap-2 text-xs font-medium text-ink/55 dark:text-paper/55">
                                <time
                                    datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                                    {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? '') }}
                                </time>
                                <span class="h-1 w-1 rounded-full bg-sage/60"></span>
                                <span>{{ $post->reading_time }} min</span>
                            </div>
                            <p class="mt-4 line-clamp-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                {{ $post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
                            </p>
                        </div>
                    </article>

                    @if ($loop->last)
                        </div>
                    @endif
                @endif
            @empty
                <div
                    class="reveal rounded-3xl border border-dashed border-ink/20 bg-paper/50 p-14 text-center dark:border-paper/15 dark:bg-paper/5"
                    data-reveal>
                    <p class="text-lg text-ink/70 dark:text-paper/70">Brak artykułów do wyświetlenia.</p>
                    @if (Route::has('posts.create'))
                        <a href="{{ route('posts.create') }}"
                            class="mt-6 inline-block text-sm font-semibold text-sage-700 underline-offset-4 transition hover:underline dark:text-sage-200">
                            Dodaj pierwszy wpis
                        </a>
                    @endif
                </div>
            @endforelse

            @if ($posts->hasPages())
                <div class="mt-12 border-t border-ink/10 pt-10 dark:border-paper/10">
                    {{ $posts->links('partials.pagination') }}
                </div>
            @endif
        </section>
    </main>
</x-layout>
