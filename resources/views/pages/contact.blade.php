<x-layout>
    <main class="bg-slate-50 dark:bg-slate-900">
        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db] dark:text-sky-300">
                            Skontaktuj się</p>
                        <h1 class="mt-3 text-4xl font-bold tracking-[-0.02em] text-slate-900 dark:text-white">Kontakt
                        </h1>
                        <p class="mt-4 max-w-2xl text-slate-600 dark:text-slate-300">
                            Napisz, jeśli potrzebujesz konsultacji, chcesz dopytać o terapię albo po prostu potrzebujesz
                            wskazówki, od czego zacząć.
                        </p>
                    </div>

                    @if (session('contact_status'))
                        <div
                            class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">
                            {{ session('contact_status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}"
                        class="rounded-3xl border border-sky-100 bg-white p-6 shadow-[0_18px_50px_rgba(11,42,74,0.08)] dark:border-slate-800 dark:bg-slate-950 dark:shadow-none sm:p-8">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <label class="block sm:col-span-1">
                                <span class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Imię i
                                    nazwisko</span>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">
                                @error('name')
                                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="block sm:col-span-1">
                                <span
                                    class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">E-mail</span>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">
                                @error('email')
                                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="block sm:col-span-2">
                                <span
                                    class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Telefon</span>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    placeholder="Opcjonalnie"
                                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">
                                @error('phone')
                                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </label>

                            <label class="block sm:col-span-2">
                                <span
                                    class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Wiadomość</span>
                                <textarea name="content" rows="6" required
                                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:bg-white focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:bg-slate-950 dark:focus:ring-sky-400/15">{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-2xl bg-[#3498db] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#2d83bd] hover:shadow-lg">
                                Wyślij wiadomość
                            </button>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Odpowiadamy najszybciej jak to
                                możliwe.</p>
                        </div>
                    </form>
                </div>

                <aside
                    class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950 sm:p-8">
                    <h2 class="text-2xl font-semibold tracking-[-0.02em] text-slate-900 dark:text-white">Lokalizacje
                        gabinetu</h2>

                    @forelse ($locations as $location)
                        <div
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-5 dark:border-slate-800 dark:bg-slate-900">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $location->name }}</h3>
                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $location->address }}</p>
                            <p
                                class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                                {{ $location->hours }}</p>
                            <a href="{{ $location->map_link }}" target="_blank" rel="noopener noreferrer"
                                class="mt-4 inline-flex text-sm font-semibold text-[#3498db] transition hover:text-[#2d83bd] dark:text-sky-300 dark:hover:text-sky-200">
                                Otwórz mapę w nowej karcie
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-slate-600 dark:text-slate-300">Brak zdefiniowanych lokalizacji.</p>
                    @endforelse
                </aside>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8">
            <div
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-950">
                <div class="border-b border-slate-100 px-6 py-6 dark:border-slate-800 sm:px-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#3498db] dark:text-sky-300">Dojazd
                        i godziny</p>
                    <h2 class="mt-2 text-2xl font-semibold tracking-[-0.02em] text-slate-900 dark:text-white">Zobacz,
                        gdzie przyjmujemy pacjentów</h2>
                </div>

                <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-2">
                    @forelse ($locations as $location)
                        <article
                            class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900">
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $location->name }}
                                </h3>
                                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $location->address }}</p>
                                <p
                                    class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-600 dark:text-slate-300">
                                    {{ $location->hours }}</p>
                            </div>
                            <iframe class="h-72 w-full border-t border-slate-200 dark:border-slate-800"
                                src="{{ $location->map_link }}" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                        </article>
                    @empty
                        <p class="text-sm text-slate-600 dark:text-slate-300">Brak zdefiniowanych lokalizacji.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-layout>
