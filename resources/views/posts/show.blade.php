<x-layout :meta-title="$post->title . ' | Blog'" :meta-description="$post->excerpt ?: ($post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160))" :canonical="route('posts.show', $post->slug)" :og-image="$post->getFirstMediaUrl('featured_image') ?:
    ($post->image_path
        ? asset('storage/' . ltrim($post->image_path, '/'))
        : asset('images/LOGO%20BLACK.png'))" og-type="article">
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

    @php
        $featuredImageUrl =
            $post->getFirstMediaUrl('featured_image') ?:
            ($post->image_path || $post->photo ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/')) : null);
    @endphp

    <main class="bg-paper text-ink dark:bg-ink dark:text-paper">
        <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
            <a href="{{ route('posts.index') }}"
                class="reveal inline-flex items-center gap-2 rounded-full border border-ink/10 bg-paper/70 px-4 py-2 text-sm font-semibold text-ink shadow-sm transition hover:border-sage/50 dark:border-paper/10 dark:bg-paper/5 dark:text-paper"
                data-reveal>
                <span aria-hidden="true">←</span>
                Powrót do listy
            </a>

            <article class="reveal mt-8 overflow-hidden rounded-3xl border border-ink/10 bg-paper/70 dark:border-paper/10 dark:bg-paper/5"
                data-reveal>
                <div class="relative h-[42svh] min-h-[220px] w-full overflow-hidden bg-paper-200 sm:h-[48svh] dark:bg-paper/10">
                    @if ($featuredImageUrl)
                        <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @else
                        <div
                            class="flex h-full items-center justify-center bg-linear-to-br from-paper-200 to-paper-400 dark:from-paper/10 dark:to-paper/5">
                            <x-brand.logo size="h-20" :linked="false" />
                        </div>
                    @endif
                    <div
                        class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/45 via-ink/10 to-transparent dark:from-ink/70">
                    </div>
                </div>

                <div class="mx-auto max-w-3xl px-6 py-10 sm:px-10 lg:px-12 lg:py-14">
                    <nav class="reveal mb-8 flex flex-wrap items-center gap-2 text-sm text-ink/55 dark:text-paper/55"
                        aria-label="Breadcrumb" data-reveal>
                        <a href="{{ route('home') }}"
                            class="font-medium transition hover:text-sage-700 dark:hover:text-sage-200">Strona główna</a>
                        <span aria-hidden="true" class="text-ink/35 dark:text-paper/35">/</span>
                        <a href="{{ route('posts.index') }}"
                            class="font-medium transition hover:text-sage-700 dark:hover:text-sage-200">Blog</a>
                        <span aria-hidden="true" class="text-ink/35 dark:text-paper/35">/</span>
                        <span class="font-medium text-ink/80 dark:text-paper/80">{{ \Illuminate\Support\Str::limit($post->title, 48) }}</span>
                    </nav>

                    <div class="reveal mb-10 flex flex-wrap items-center gap-3 border-b border-ink/10 pb-8 text-sm dark:border-paper/10"
                        data-reveal>
                        <span
                            class="rounded-full border border-ink/10 bg-paper/80 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-ink/70 dark:border-paper/10 dark:bg-paper/10 dark:text-paper/75">
                            {{ $post->is_published ? 'Opublikowano' : 'Szkic' }}
                        </span>
                        <span class="h-1 w-1 rounded-full bg-sage/70"></span>
                        <span class="font-medium text-ink dark:text-paper">{{ $post->author }}</span>
                        <span class="h-1 w-1 rounded-full bg-sage/70"></span>
                        <time
                            datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                            {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji') }}
                        </time>
                        <span class="h-1 w-1 rounded-full bg-sage/70"></span>
                        <span class="font-medium text-sage-700 dark:text-sage-200">{{ $post->reading_time }} min czytania</span>
                        <span class="h-1 w-1 rounded-full bg-sage/70"></span>
                        <span class="text-ink/60 dark:text-paper/60">Aktualizacja:
                            {{ $post->updated_at?->translatedFormat('d F Y') }}</span>
                    </div>

                    <header class="reveal" data-reveal>
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-sage-700 dark:text-sage-200">
                            {{ $post->category?->name ?? 'Bez kategorii' }}
                        </p>
                        <h1 class="mt-4 text-ink dark:text-paper">
                            {{ $post->title }}
                        </h1>
                        @if ($post->lead)
                            <p class="lead mt-6 text-ink/75 dark:text-paper/75">
                                {{ $post->lead }}
                            </p>
                        @endif
                    </header>

                    <div class="article-body mt-10 max-w-none text-base">
                        {!! $post->content !!}
                    </div>

                    <section
                        class="reveal relative mt-14 overflow-hidden rounded-3xl border border-sage/25 bg-ink p-8 text-paper shadow-[0_28px_90px_rgba(26,26,26,0.25)] sm:p-10"
                        data-reveal>
                        <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-sage/20 blur-3xl">
                        </div>
                        <h2 class="text-2xl text-paper sm:text-3xl">Umów się na wizytę</h2>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-paper/75">
                            Potrzebujesz indywidualnej diagnostyki i planu terapii? Skontaktuj się z gabinetem Ostrowski
                            Fizjoterapia i umów dogodny termin konsultacji.
                        </p>
                        <div class="mt-8">
                            <a href="{{ route('pages.contact') }}" class="btn bg-paper text-ink hover:bg-paper/90">
                                Umów wizytę
                            </a>
                        </div>
                    </section>

                    <div class="reveal mt-12" data-reveal>
                        <livewire:post-comments :post="$post" />
                    </div>

                    @if ($relatedPosts->isNotEmpty())
                        <section class="reveal mt-14 border-t border-ink/10 pt-12 dark:border-paper/10" data-reveal>
                            <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
                                <h2 class="text-ink dark:text-paper">
                                    Powiązane wpisy
                                </h2>
                                <a href="{{ route('posts.index') }}"
                                    class="text-sm font-semibold text-sage-700 transition hover:text-sage-600 dark:text-sage-200 dark:hover:text-sage-100">
                                    Wszystkie wpisy
                                </a>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($relatedPosts as $relatedPost)
                                    <article
                                        class="group flex flex-col rounded-2xl border border-ink/10 bg-paper/60 p-5 transition hover:-translate-y-0.5 hover:border-sage/30 dark:border-paper/10 dark:bg-paper/5">
                                        <h3 class="text-base font-semibold text-ink dark:text-paper">
                                            <a href="{{ route('posts.show', $relatedPost->slug) }}"
                                                class="transition group-hover:text-sage-700 dark:group-hover:text-sage-200">
                                                {{ $relatedPost->title }}
                                            </a>
                                        </h3>
                                        <p class="mt-2 text-sm leading-6 text-ink/70 dark:text-paper/70">
                                            {{ $relatedPost->excerpt ?: ($relatedPost->lead ?: 'Przeczytaj pełny wpis.') }}
                                        </p>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>
            </article>
        </div>
    </main>
</x-layout>
