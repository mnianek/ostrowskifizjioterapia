<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db]">Kanał edukacyjny</p>
        <h1 class="mt-3 text-4xl font-bold text-slate-900">YouTube</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Materiały wideo z ćwiczeniami i edukacją dla pacjentów.</p>

        <div class="mt-8 grid gap-8 md:grid-cols-2">
            @forelse ($videos as $video)
                <article
                    class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    @if ($video->embed_url)
                        <iframe class="aspect-video w-full" src="{{ $video->embed_url }}" title="{{ $video->title }}"
                            loading="lazy" allowfullscreen></iframe>
                    @else
                        <div class="flex aspect-video items-center justify-center bg-slate-100 text-sm text-slate-500">
                            Nieprawidłowy URL YouTube
                        </div>
                    @endif

                    <div class="p-5">
                        <h2 class="text-xl font-semibold text-slate-900">{{ $video->title }}</h2>
                        <p class="mt-2 text-sm text-slate-600">{{ $video->description }}</p>
                    </div>
                </article>
            @empty
                <p class="text-slate-600">Brak filmów do wyświetlenia.</p>
            @endforelse
        </div>
    </main>
</x-layout>
