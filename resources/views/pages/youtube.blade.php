<x-layout :meta-title="$settings->hero_title . ' - ' . config('app.name')" :meta-description="$settings->hero_description" :canonical="route('pages.youtube')">
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <section class="reveal" data-reveal>
            <div class="surface-glass relative overflow-hidden p-8 sm:p-10">
                <div class="pointer-events-none absolute inset-0 -z-10">
                    <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-sage/20 blur-3xl dark:bg-sage/15">
                    </div>
                    <div
                        class="absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-ink/10 blur-3xl dark:bg-paper/10">
                    </div>
                </div>

                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                    {{ $settings->hero_kicker }}
                </p>
                <h1 class="mt-4 max-w-3xl text-ink dark:text-paper">
                    {{ $settings->hero_title }}
                </h1>
                <p class="lead mt-5 max-w-2xl text-ink/70 dark:text-paper/70">
                    {{ $settings->hero_description }}
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('analytics.youtube-channel') }}" class="btn-primary">
                        {{ $settings->cta_label }}
                    </a>
                    <a href="#videos" class="btn-secondary">
                        Zobacz filmy
                    </a>
                </div>
            </div>
        </section>

        <section id="videos" class="mt-14">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        {{ $settings->section_title }}
                    </p>
                    <h2 class="mt-3 text-ink dark:text-paper">
                        Obejrzyj wybrane materiały
                    </h2>
                </div>
                <p class="max-w-xl text-sm leading-7 text-ink/70 dark:text-paper/70">
                    {{ $settings->section_description }}
                </p>
            </div>

            <div class="mt-8 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($videos as $video)
                    <article
                        class="surface-card overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(26,26,26,0.14)] dark:hover:shadow-none">
                        @if ($video->embed_url)
                            <iframe class="aspect-video w-full" src="{{ $video->embed_url }}"
                                title="{{ $video->title }}" loading="lazy" allowfullscreen></iframe>
                        @else
                            <div
                                class="flex aspect-video items-center justify-center bg-paper-100 text-sm text-ink/60 dark:bg-paper/10 dark:text-paper/60">
                                Nieprawidłowy URL YouTube
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-ink dark:text-paper">{{ $video->title }}</h3>
                            @if ($video->description)
                                <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                    {{ $video->description }}
                                </p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div
                        class="rounded-3xl border border-dashed border-ink/20 bg-paper/70 p-10 text-ink/70 dark:border-paper/20 dark:bg-paper/5 dark:text-paper/70">
                        Brak filmów do wyświetlenia.
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</x-layout>
