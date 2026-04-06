<x-layout>
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db]">Skontaktuj się</p>
        <h1 class="mt-3 text-4xl font-bold text-slate-900">Kontakt</h1>
        <p class="mt-4 max-w-2xl text-slate-600">Sprawdź lokalizacje gabinetu i godziny przyjęć.</p>

        <div class="mt-8 space-y-8">
            @forelse ($locations as $location)
                <section class="grid gap-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm lg:grid-cols-2">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900">{{ $location->name }}</h2>
                        <p class="mt-3 text-slate-700">{{ $location->address }}</p>
                        <p class="mt-4 whitespace-pre-line text-sm text-slate-600">{{ $location->hours }}</p>
                        <a href="{{ $location->map_link }}" target="_blank" rel="noopener noreferrer"
                            class="mt-5 inline-flex text-sm font-semibold text-[#3498db] hover:text-[#2d83bd]">
                            Otwórz mapę w nowej karcie
                        </a>
                    </div>

                    <div>
                        <iframe class="h-72 w-full rounded-lg border border-slate-200" src="{{ $location->map_link }}"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>
                </section>
            @empty
                <p class="text-slate-600">Brak zdefiniowanych lokalizacji.</p>
            @endforelse
        </div>
    </main>
</x-layout>
