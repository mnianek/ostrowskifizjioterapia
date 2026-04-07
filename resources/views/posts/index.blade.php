<x-layout>
    <main class="bg-slate-50 font-[Inter,Geist,ui-sans-serif,system-ui,sans-serif] dark:bg-slate-900">
        <section
            class="relative overflow-hidden border-b border-slate-100 bg-white dark:border-slate-800 dark:bg-slate-950">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_85%_10%,rgba(11,42,74,0.12),transparent_45%)]">
            </div>
            <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B2A4A]/70 dark:text-sky-300/80">
                    Ostrowski Fizjoterapia</p>
                <h1
                    class="mt-5 max-w-4xl text-4xl font-bold tracking-[-0.02em] text-slate-900 sm:text-5xl lg:text-6xl dark:text-white">
                    Baza Wiedzy Fizjoterapeutycznej
                </h1>
                <p class="mt-6 max-w-3xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                    Tworzymy praktyczne materiały o zdrowiu, ruchu i terapii, aby pomóc pacjentom wracać do sprawności
                    szybciej,
                    bezpieczniej i bardziej świadomie.
                </p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <form method="GET" action="{{ route('posts.index') }}"
                class="mb-8 rounded-3xl border border-sky-100 bg-white/95 p-4 shadow-[0_18px_50px_rgba(11,42,74,0.08)] backdrop-blur sm:p-5 dark:border-slate-800 dark:bg-slate-950/95 dark:shadow-none">
                <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_220px_180px_auto] lg:items-end">
                    @if ($selectedCategory)
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif

                    <label class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.16em] text-[#0B2A4A]/70 dark:text-slate-400">Szukaj</span>
                        <input type="search" name="search" value="{{ $search }}"
                            placeholder="Szukaj w tytułach i treści..."
                            class="w-full rounded-2xl border border-sky-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">
                    </label>

                    <label class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.16em] text-[#0B2A4A]/70 dark:text-slate-400">Sortowanie</span>
                        <select name="sort" onchange="this.form.submit()"
                            class="w-full rounded-2xl border border-sky-100 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">
                            <option value="latest" @selected($sort === 'latest')>Najnowsze</option>
                            <option value="popular" @selected($sort === 'popular')>Najpopularniejsze</option>
                            <option value="comments" @selected($sort === 'comments')>Najczęściej komentowane</option>
                        </select>
                    </label>

                    <div class="block">
                        <span
                            class="mb-2 block text-xs font-semibold uppercase tracking-[0.16em] text-[#0B2A4A]/70 dark:text-slate-400">Kierunek</span>
                        <div
                            class="grid grid-cols-2 rounded-2xl border border-sky-100 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900">
                            <label
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold transition {{ $direction === 'desc' ? 'bg-sky-500 text-white shadow-sm' : 'text-slate-600 hover:bg-white dark:text-slate-300 dark:hover:bg-slate-800' }}">
                                <input type="radio" name="direction" value="desc" class="sr-only"
                                    onchange="this.form.submit()" @checked($direction === 'desc')>
                                <x-heroicon-o-bars-arrow-down class="h-5 w-5" />
                                Malejąco
                            </label>
                            <label
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl px-3 py-3 text-sm font-semibold transition {{ $direction === 'asc' ? 'bg-sky-500 text-white shadow-sm' : 'text-slate-600 hover:bg-white dark:text-slate-300 dark:hover:bg-slate-800' }}">
                                <input type="radio" name="direction" value="asc" class="sr-only"
                                    onchange="this.form.submit()" @checked($direction === 'asc')>
                                <x-heroicon-o-bars-arrow-up class="h-5 w-5" />
                                Rosnąco
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 lg:justify-end">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-2xl bg-[#3498db] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#2d83bd] hover:shadow-lg">
                            Filtruj
                        </button>
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center justify-center rounded-2xl border border-sky-100 bg-white px-5 py-3 text-sm font-semibold text-[#0B2A4A] transition hover:border-[#3498db] hover:text-[#3498db] dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:border-sky-400 dark:hover:text-sky-300">
                            Wyczyść
                        </a>
                    </div>
                </div>
            </form>

            <div class="mb-8 flex flex-wrap items-center gap-3">
                <span
                    class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
                    Kategorie
                </span>
                <a href="{{ route('posts.index', array_filter(['search' => $search, 'sort' => $sort, 'direction' => $direction])) }}"
                    class="rounded-full border px-4 py-2 text-sm font-medium transition {{ $selectedCategory ? 'border-slate-200 bg-white text-slate-700 hover:border-[#0B2A4A]/30 hover:text-[#0B2A4A] dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:border-sky-400 dark:hover:text-sky-300' : 'border-[#0B2A4A]/30 bg-[#0B2A4A]/6 text-[#0B2A4A] dark:border-sky-400/30 dark:bg-sky-400/10 dark:text-sky-300' }}">
                    Wszystkie
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('posts.index', array_filter(['category' => $category->id, 'search' => $search, 'sort' => $sort, 'direction' => $direction])) }}"
                        class="rounded-full border px-4 py-2 text-sm font-medium transition {{ (int) $selectedCategory === (int) $category->id ? 'border-[#0B2A4A]/30 bg-[#0B2A4A]/6 text-[#0B2A4A] dark:border-sky-400/30 dark:bg-sky-400/10 dark:text-sky-300' : 'border-slate-200 bg-white text-slate-700 hover:border-[#0B2A4A]/30 hover:text-[#0B2A4A] dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:border-sky-400 dark:hover:text-sky-300' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="space-y-6">
                @forelse ($posts as $post)
                    <article
                        class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition duration-300 hover:shadow-xl md:flex dark:border-slate-800 dark:bg-slate-950 dark:hover:shadow-2xl">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block md:w-80 md:shrink-0">
                            <div class="relative h-56 overflow-hidden bg-slate-100 md:h-full">
                                @php
                                    $featuredImageUrl =
                                        $post->getFirstMediaUrl('featured_image') ?:
                                        ($post->image_path || $post->photo
                                            ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                                            : null);
                                @endphp

                                @if ($featuredImageUrl)
                                    <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div
                                        class="flex h-full items-center justify-center bg-linear-to-br from-slate-100 to-slate-200 text-xs font-semibold uppercase tracking-[0.16em] text-[#0B2A4A]/70">
                                        Ostrowski Fizjoterapia
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="space-y-4 p-6 md:flex-1">
                            <span
                                class="inline-flex rounded-full border border-[#0B2A4A]/12 bg-[#0B2A4A]/6 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#0B2A4A] dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-300">
                                {{ $post->is_published ? 'Artykuł' : 'Szkic' }}
                            </span>

                            <h2
                                class="text-2xl font-bold tracking-[-0.015em] text-slate-900 transition group-hover:text-[#0B2A4A] dark:text-white dark:group-hover:text-sky-300">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="hover:text-[#3498db]">{{ $post->title }}</a>
                            </h2>

                            <p
                                class="text-xs font-semibold uppercase tracking-[0.14em] text-[#3498db] dark:text-sky-300">
                                {{ $post->category?->name ?? 'Bez kategorii' }}
                            </p>

                            <div
                                class="flex flex-wrap items-center gap-3 text-sm font-medium text-[#3498db] dark:text-sky-300">
                                <time
                                    datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                                    {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji') }}
                                </time>
                                <span class="h-1 w-1 rounded-full bg-sky-300"></span>
                                <span>⏱ {{ $post->reading_time }} min czytania</span>
                            </div>

                            <p class="line-clamp-3 text-sm leading-7 text-slate-600 dark:text-slate-300">
                                {{ $post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 165) }}
                            </p>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center dark:border-slate-700 dark:bg-slate-950">
                        <p class="text-lg text-slate-600 dark:text-slate-300">Brak artykułów do wyświetlenia.</p>
                        <a href="{{ route('posts.create') }}"
                            class="mt-4 inline-block font-semibold text-[#0B2A4A] transition hover:text-[#153f6b] dark:text-sky-300 dark:hover:text-sky-200">
                            Dodaj pierwszy wpis
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($posts->hasPages())
                <div class="mt-10 border-t border-slate-100 pt-8 dark:border-slate-800">
                    {{ $posts->links('partials.pagination') }}
                </div>
            @endif
        </section>
    </main>
</x-layout>
