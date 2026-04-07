<x-layout :meta-title="$post->title . ' | Blog'" :meta-description="$post->excerpt ?: ($post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160))"
    :canonical="route('posts.show', $post->slug)"
    :og-image="$post->getFirstMediaUrl('featured_image') ?: ($post->image_path ? asset('storage/' . ltrim($post->image_path, '/')) : asset('images/LOGO%20BLACK.png'))"
    og-type="article">
    @push('structured-data')
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $post->title,
                'description' => $post->excerpt ?: ($post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160)),
                'author' => [
                    '@type' => 'Person',
                    'name' => $post->author,
                ],
                'datePublished' => optional($post->published_at)->toIso8601String(),
                'dateModified' => optional($post->updated_at)->toIso8601String(),
                'mainEntityOfPage' => route('posts.show', $post->slug),
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
    @endpush

    <main class="bg-slate-50 font-[Inter,Geist,ui-sans-serif,system-ui,sans-serif] dark:bg-slate-900">
        <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <a href="{{ route('posts.index') }}"
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-[#0B2A4A] shadow-sm transition hover:border-[#0B2A4A]/30 hover:text-[#153f6b] dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:hover:border-sky-400 dark:hover:text-sky-300">
                <span aria-hidden="true">←</span>
                Powrót do listy
            </a>

            <article
                class="mt-6 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-950">
                <div class="h-80 w-full overflow-hidden bg-slate-100 sm:h-105">
                    @php
                        $featuredImageUrl =
                            $post->getFirstMediaUrl('featured_image') ?:
                            ($post->image_path || $post->photo
                                ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                                : null);
                    @endphp

                    @if ($featuredImageUrl)
                        <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @else
                        <div
                            class="flex h-full items-center justify-center bg-linear-to-br from-slate-100 to-slate-200 text-sm font-semibold uppercase tracking-[0.18em] text-[#0B2A4A]/65 dark:from-slate-800 dark:to-slate-900">
                            <x-brand.logo size="h-16" :linked="false" />
                        </div>
                    @endif
                </div>

                <div class="mx-auto max-w-3xl px-6 py-10 sm:px-10 lg:px-0 lg:py-14">
                    <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-slate-400"
                        aria-label="Breadcrumb">
                        <a href="{{ route('home') }}"
                            class="font-medium transition hover:text-[#3498db] dark:hover:text-sky-300">Strona
                            Główna</a>
                        <span aria-hidden="true" class="text-gray-400 dark:text-slate-600">/</span>
                        <a href="{{ route('posts.index') }}"
                            class="font-medium transition hover:text-[#3498db] dark:hover:text-sky-300">Blog</a>
                        <span aria-hidden="true" class="text-gray-400 dark:text-slate-600">/</span>
                        <span class="font-medium text-slate-600 dark:text-slate-300">{{ $post->title }}</span>
                    </nav>

                    <div
                        class="mb-8 flex flex-wrap items-center gap-3 border-b border-slate-100 pb-6 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400">
                        <span
                            class="rounded-full border border-[#0B2A4A]/15 bg-[#0B2A4A]/6 px-3 py-1 font-semibold uppercase tracking-[0.12em] text-[#0B2A4A] dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-300">
                            {{ $post->is_published ? 'Opublikowano' : 'Szkic' }}
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="font-medium text-slate-700 dark:text-slate-300">{{ $post->author }}</span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <time
                            datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                            {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji') }}
                        </time>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="font-medium text-[#3498db] dark:text-sky-300">⏱ {{ $post->reading_time }} min
                            czytania</span>
                    </div>

                    <header>
                        <h1 class="text-4xl font-bold tracking-[-0.02em] text-slate-900 sm:text-5xl dark:text-white">
                            {{ $post->title }}
                        </h1>
                        @if ($post->lead)
                            <p class="mt-6 text-xl leading-relaxed text-slate-600 dark:text-slate-300">
                                {{ $post->lead }}
                            </p>
                        @endif
                    </header>

                    <div
                        class="prose prose-lg mt-10 max-w-none leading-8 text-slate-700 prose-headings:tracking-[-0.015em] prose-headings:text-[#0B2A4A] prose-strong:text-slate-900 prose-a:text-[#0B2A4A] prose-a:no-underline hover:prose-a:text-[#153f6b] prose-li:marker:text-[#0B2A4A]/70 dark:prose-invert dark:text-slate-300 dark:prose-headings:text-white dark:prose-strong:text-white dark:prose-a:text-sky-300 dark:hover:prose-a:text-sky-200 dark:prose-li:marker:text-sky-300/70">
                        {!! $post->content !!}
                    </div>

                    <section
                        class="mt-12 rounded-2xl border border-slate-100 bg-slate-50 p-6 sm:p-8 dark:border-slate-800 dark:bg-slate-900">
                        <h2 class="text-2xl font-bold tracking-[-0.015em] text-slate-900 dark:text-white">Umów się na
                            wizytę</h2>
                        <p class="mt-3 max-w-2xl text-base leading-relaxed text-slate-600 dark:text-slate-300">
                            Potrzebujesz indywidualnej diagnostyki i planu terapii? Skontaktuj się z gabinetem Ostrowski
                            Fizjoterapia i umów dogodny termin konsultacji.
                        </p>
                        <div class="mt-6">
                            <a href="#"
                                class="inline-flex items-center rounded-xl bg-[#0B2A4A] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#153f6b] hover:shadow-lg">
                                Umów wizytę
                            </a>
                        </div>
                    </section>

                    <livewire:post-comments :post="$post" />

                    @if ($relatedPosts->isNotEmpty())
                        <section class="mt-12 border-t border-slate-100 pt-10 dark:border-slate-800">
                            <div class="mb-5 flex items-center justify-between gap-3">
                                <h2 class="text-2xl font-bold tracking-[-0.015em] text-slate-900 dark:text-white">
                                    Powiazane wpisy
                                </h2>
                                <a href="{{ route('posts.index') }}"
                                    class="text-sm font-semibold text-[#0B2A4A] transition hover:text-[#153f6b] dark:text-sky-300 dark:hover:text-sky-200">
                                    Wszystkie wpisy
                                </a>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($relatedPosts as $relatedPost)
                                    <article
                                        class="rounded-xl border border-slate-200 bg-white p-4 transition hover:-translate-y-0.5 hover:shadow-sm dark:border-slate-700 dark:bg-slate-900/70">
                                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">
                                            <a href="{{ route('posts.show', $relatedPost->slug) }}"
                                                class="transition hover:text-[#3498db] dark:hover:text-sky-300">
                                                {{ $relatedPost->title }}
                                            </a>
                                        </h3>
                                        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                            {{ $relatedPost->excerpt ?: ($relatedPost->lead ?: 'Przeczytaj pelny wpis.') }}
                                        </p>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>
            </article>
        </section>
    </main>
</x-layout>
