<x-layout :meta-title="$settings->hero_title . ' - ' . config('app.name')" :meta-description="$settings->hero_description" :canonical="route('pages.youtube')">
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <section>
            <div
                class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white/90 p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)] backdrop-blur dark:border-slate-800 dark:bg-slate-900/80 sm:p-10">
                <div
                    class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.14),transparent_45%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.12),transparent_42%)] dark:bg-[radial-gradient(circle_at_top_left,rgba(59,130,246,0.2),transparent_45%),radial-gradient(circle_at_bottom_right,rgba(16,185,129,0.14),transparent_42%)]">
                </div>

                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-sky-600 dark:text-sky-400">
                    {{ $settings->hero_kicker }}
                </p>
                <h1
                    class="mt-4 max-w-3xl text-4xl font-extrabold tracking-tight text-slate-950 dark:text-white sm:text-5xl">
                    {{ $settings->hero_title }}
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600 dark:text-slate-300">
                    {{ $settings->hero_description }}
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('analytics.youtube-channel') }}"
                        class="inline-flex items-center justify-center rounded-full bg-sky-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-500">
                        {{ $settings->cta_label }}
                    </a>
                    <a href="#videos"
                        class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-950 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-slate-500 dark:hover:text-white">
                        Zobacz filmy
                    </a>
                </div>
            </div>
        </section>

        <section id="videos" class="mt-14">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-sky-600 dark:text-sky-400">
                        {{ $settings->section_title }}
                    </p>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight text-slate-950 dark:text-white">
                        Obejrzyj wybrane materiały
                    </h2>
                </div>
                <p class="max-w-xl text-sm leading-6 text-slate-600 dark:text-slate-400">
                    {{ $settings->section_description }}
                </p>
            </div>

            <div class="mt-8 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($videos as $video)
                    <article
                        class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_14px_40px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(15,23,42,0.12)] dark:border-slate-800 dark:bg-slate-900">
                        @if ($video->embed_url)
                            <iframe class="aspect-video w-full" src="{{ $video->embed_url }}"
                                title="{{ $video->title }}" loading="lazy" allowfullscreen></iframe>
                        @else
                            <div
                                class="flex aspect-video items-center justify-center bg-slate-100 text-sm text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                Nieprawidłowy URL YouTube
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-slate-950 dark:text-white">{{ $video->title }}</h3>
                            @if ($video->description)
                                <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-400">
                                    {{ $video->description }}
                                </p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div
                        class="rounded-[1.5rem] border border-dashed border-slate-300 bg-white p-10 text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">
                        Brak filmów do wyświetlenia.
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</x-layout>
