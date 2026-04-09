<footer class="mt-16 border-t border-ink/10 bg-paper/70 backdrop-blur-xl dark:border-paper/10 dark:bg-ink/60">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.8fr_1.3fr]">
            <div class="reveal" data-reveal>
                <x-brand.logo size="h-12" />
                <p class="mt-3 max-w-sm text-sm leading-7 text-ink/70 dark:text-paper/70">Nowoczesna terapia bólu
                    i powrót do aktywności przez ruch, edukację i plan oparty na danych.</p>
                <div class="mt-5 flex items-center gap-2">
                    <x-ui.badge tone="secondary">Plan terapii</x-ui.badge>
                    <x-ui.badge tone="accent">Konsultacja 1:1</x-ui.badge>
                </div>
            </div>

            <div class="reveal" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/55">Nawigacja
                </p>
                <div class="mt-4 grid gap-2 text-sm">
                    <a href="{{ route('home') }}"
                        class="text-ink/70 transition hover:text-sage-700 dark:text-paper/70 dark:hover:text-sage-200">Start</a>
                    <a href="{{ route('posts.index') }}"
                        class="text-ink/70 transition hover:text-sage-700 dark:text-paper/70 dark:hover:text-sage-200">Blog</a>
                    <a href="{{ route('pages.about') }}"
                        class="text-ink/70 transition hover:text-sage-700 dark:text-paper/70 dark:hover:text-sage-200">O
                        mnie</a>
                    <a href="{{ route('pages.youtube') }}"
                        class="text-ink/70 transition hover:text-sage-700 dark:text-paper/70 dark:hover:text-sage-200">YouTube</a>
                    <a href="{{ route('pages.contact') }}"
                        class="text-ink/70 transition hover:text-sage-700 dark:text-paper/70 dark:hover:text-sage-200">Kontakt</a>
                </div>
            </div>

            <div class="reveal" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/55">
                    Newsletter</p>
                <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">Raz w tygodniu: praktyczne wskazówki i nowe
                    wpisy o zdrowym ruchu.</p>

                @if (session('newsletter_status'))
                    <div
                        class="mt-4 rounded-2xl border border-sage-300/60 bg-sage-100/70 px-4 py-3 text-sm font-medium text-sage-800 dark:border-sage-600/35 dark:bg-sage-900/20 dark:text-sage-200">
                        {{ session('newsletter_status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('newsletter.subscribe') }}"
                    class="mt-4 flex flex-col gap-3 rounded-2xl border border-ink/10 bg-paper/60 p-4 dark:border-paper/10 dark:bg-paper/5 sm:flex-row sm:items-end">
                    @csrf

                    <div class="flex-1">
                        <x-ui.input type="email" name="email" label="Adres e-mail" required
                            placeholder="twoj@email.com" value="{{ old('email') }}" />

                        <label
                            class="mt-2 inline-flex items-start gap-2 text-xs leading-5 text-ink/70 dark:text-paper/70">
                            <input type="checkbox" name="privacy_consent" value="1" required
                                @checked(old('privacy_consent'))
                                class="mt-0.5 h-4 w-4 rounded border-ink/25 bg-paper text-sage focus:ring-sage/30 dark:border-paper/25 dark:bg-paper/5 dark:text-sage">
                            <span>
                                Zgadzam się na przetwarzanie danych zgodnie z
                                <a href="{{ route('pages.privacy-policy') }}"
                                    class="font-semibold text-sage-700 underline decoration-sage/35 underline-offset-4 hover:text-sage-600 dark:text-sage-200 dark:decoration-sage/40 dark:hover:text-sage-100">Polityką
                                    prywatności</a>.
                            </span>
                        </label>
                        @error('privacy_consent')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-ui.button type="submit" variant="primary" class="sm:mb-px">
                        Zapisz się
                    </x-ui.button>
                </form>

                <p class="mt-2 text-xs leading-5 text-ink/55 dark:text-paper/55">
                    Administratorem danych jest właściciel serwisu. Dane podane przy zapisie do newslettera
                    wykorzystujemy tylko do wysyłki treści edukacyjnych.
                </p>
            </div>
        </div>

        <p class="mt-10 border-t border-ink/10 pt-6 text-xs text-ink/55 dark:border-paper/10 dark:text-paper/55">
            © 2026. Wszelkie prawa zastrzeżone.
        </p>
        <div class="mt-3 flex flex-wrap gap-4 text-xs text-ink/55 dark:text-paper/55">
            <a href="{{ route('pages.privacy-policy') }}"
                class="transition hover:text-sage-700 dark:hover:text-sage-200">Polityka
                prywatności</a>
            <a href="{{ route('pages.cookies') }}" class="transition hover:text-sage-700 dark:hover:text-sage-200">Cookies</a>
            <a href="{{ route('pages.terms') }}" class="transition hover:text-sage-700 dark:hover:text-sage-200">Regulamin</a>
            <a href="{{ route('pages.contact') }}" class="transition hover:text-sage-700 dark:hover:text-sage-200">Kontakt</a>
        </div>
    </div>
</footer>
