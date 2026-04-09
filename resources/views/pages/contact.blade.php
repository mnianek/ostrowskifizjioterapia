<x-layout>
    <main class="relative">
        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
                <div class="reveal space-y-6" data-reveal>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                            Skontaktuj się
                        </p>
                        <h1 class="mt-3 text-ink dark:text-paper">Kontakt</h1>
                        <p class="lead mt-4 max-w-2xl text-ink/70 dark:text-paper/70">
                            Napisz, jeśli potrzebujesz konsultacji, chcesz dopytać o terapię albo po prostu
                            potrzebujesz wskazówki, od czego zacząć.
                        </p>
                    </div>

                    @if (session('contact_status'))
                        <div
                            class="rounded-2xl border border-sage-300/60 bg-sage-100/70 px-4 py-3 text-sm font-medium text-sage-800 dark:border-sage-600/35 dark:bg-sage-900/20 dark:text-sage-200">
                            {{ session('contact_status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="surface-glass p-6 sm:p-8">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <x-ui.input name="name" label="Imię i nazwisko" :value="old('name')" required />
                            </div>

                            <div class="sm:col-span-1">
                                <x-ui.input type="email" name="email" label="E-mail" :value="old('email')" required />
                            </div>

                            <div class="sm:col-span-2">
                                <x-ui.input name="phone" label="Telefon" :value="old('phone')" placeholder="Opcjonalnie" />
                            </div>

                            <div class="sm:col-span-2">
                                <x-ui.textarea name="content" label="Wiadomość" rows="6" required>{{ old('content') }}</x-ui.textarea>
                            </div>

                            <label class="block sm:col-span-2">
                                <span class="inline-flex items-start gap-3 text-sm text-ink/80 dark:text-paper/80">
                                    <input type="checkbox" name="privacy_consent" value="1" required
                                        @checked(old('privacy_consent'))
                                        class="mt-0.5 h-4 w-4 rounded border-ink/25 bg-paper text-sage focus:ring-sage/30 dark:border-paper/25 dark:bg-paper/5 dark:text-sage">
                                    <span>
                                        Akceptuję przetwarzanie moich danych osobowych zgodnie z
                                        <a href="{{ route('pages.privacy-policy') }}"
                                            class="font-semibold text-sage-700 underline decoration-sage/35 underline-offset-4 hover:text-sage-600 dark:text-sage-200 dark:decoration-sage/40 dark:hover:text-sage-100">Polityka
                                            prywatności</a>.
                                    </span>
                                </span>
                                @error('privacy_consent')
                                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <p class="mt-4 text-xs leading-6 text-ink/55 dark:text-paper/55">
                            Administratorem danych jest właściciel serwisu. Dane z formularza kontaktowego przetwarzamy
                            wyłącznie w celu odpowiedzi na zapytanie. Szczegóły znajdziesz w
                            <a href="{{ route('pages.privacy-policy') }}"
                                class="font-semibold text-sage-700 underline decoration-sage/35 underline-offset-4 hover:text-sage-600 dark:text-sage-200 dark:decoration-sage/40 dark:hover:text-sage-100">Polityce
                                prywatności</a>.
                        </p>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <button type="submit" class="btn-primary">Wyślij wiadomość</button>
                            <p class="text-xs text-ink/55 dark:text-paper/55">Odpowiadamy najszybciej jak to możliwe.</p>
                        </div>
                    </form>
                </div>

                <aside class="reveal surface-glass space-y-4 p-6 sm:p-8" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        Placówki
                    </p>
                    <h2 class="text-ink dark:text-paper">Lokalizacje gabinetu</h2>

                    @forelse ($locations as $location)
                        <div class="surface-card p-5">
                            <h3 class="text-ink dark:text-paper">{{ $location->name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-ink/70 dark:text-paper/70">{{ $location->address }}</p>
                            <p class="mt-3 whitespace-pre-line text-sm leading-7 text-ink/70 dark:text-paper/70">
                                {{ $location->hours }}
                            </p>
                            <a href="{{ $location->map_link }}" target="_blank" rel="noopener noreferrer"
                                class="mt-4 inline-flex text-sm font-semibold text-sage-700 transition hover:text-sage-600 dark:text-sage-200 dark:hover:text-sage-100">
                                Otwórz mapę w nowej karcie
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-ink/70 dark:text-paper/70">Brak zdefiniowanych lokalizacji.</p>
                    @endforelse
                </aside>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8">
            <div class="reveal surface-glass overflow-hidden" data-reveal>
                <div class="border-b border-ink/10 px-6 py-6 dark:border-paper/10 sm:px-8">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        Dojazd i godziny
                    </p>
                    <h2 class="mt-2 text-ink dark:text-paper">Zobacz, gdzie przyjmujemy pacjentów</h2>
                </div>

                <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-2">
                    @forelse ($locations as $location)
                        <article class="surface-card overflow-hidden">
                            <div class="p-5">
                                <h3 class="text-ink dark:text-paper">{{ $location->name }}</h3>
                                <p class="mt-2 text-sm leading-6 text-ink/70 dark:text-paper/70">{{ $location->address }}</p>
                                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-ink/70 dark:text-paper/70">
                                    {{ $location->hours }}
                                </p>
                            </div>
                            <iframe class="h-72 w-full border-t border-ink/10 dark:border-paper/10"
                                src="{{ $location->map_link }}" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                        </article>
                    @empty
                        <p class="text-sm text-ink/70 dark:text-paper/70">Brak zdefiniowanych lokalizacji.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-layout>
