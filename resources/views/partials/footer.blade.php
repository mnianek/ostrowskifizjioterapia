<footer
    class="mt-16 border-t border-slate-200/80 bg-white/80 backdrop-blur-sm dark:border-slate-800 dark:bg-slate-950/70">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr_1.2fr]">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-brand-600 dark:text-brand-300">Ostrowski
                    Fizjoterapia</p>
                <p class="mt-3 max-w-sm text-sm leading-6 text-slate-600 dark:text-slate-300">Nowoczesna terapia bólu
                    i powrót do aktywności przez ruch, edukację i plan oparty na danych.</p>
                <div class="mt-5 flex items-center gap-2">
                    <x-ui.badge tone="secondary">Plan terapii</x-ui.badge>
                    <x-ui.badge tone="accent">Konsultacja 1:1</x-ui.badge>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Nawigacja
                </p>
                <div class="mt-4 grid gap-2 text-sm">
                    <a href="{{ route('home') }}"
                        class="text-slate-600 transition hover:text-brand-600 dark:text-slate-300 dark:hover:text-brand-300">Start</a>
                    <a href="{{ route('posts.index') }}"
                        class="text-slate-600 transition hover:text-brand-600 dark:text-slate-300 dark:hover:text-brand-300">Blog</a>
                    <a href="{{ route('pages.about') }}"
                        class="text-slate-600 transition hover:text-brand-600 dark:text-slate-300 dark:hover:text-brand-300">O
                        mnie</a>
                    <a href="{{ route('pages.youtube') }}"
                        class="text-slate-600 transition hover:text-brand-600 dark:text-slate-300 dark:hover:text-brand-300">YouTube</a>
                    <a href="{{ route('pages.contact') }}"
                        class="text-slate-600 transition hover:text-brand-600 dark:text-slate-300 dark:hover:text-brand-300">Kontakt</a>
                </div>
            </div>

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">
                    Newsletter</p>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Raz w tygodniu: praktyczne wskazówki i nowe
                    wpisy o zdrowym ruchu.</p>

                @if (session('newsletter_status'))
                    <div
                        class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">
                        {{ session('newsletter_status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('newsletter.subscribe') }}"
                    class="mt-4 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50/90 p-4 dark:border-slate-800 dark:bg-slate-900/80 sm:flex-row sm:items-end">
                    @csrf

                    <div class="flex-1">
                        <x-ui.input type="email" name="email" label="Adres e-mail" required
                            placeholder="twoj@email.com" value="{{ old('email') }}" />
                    </div>

                    <x-ui.button type="submit" variant="primary" class="sm:mb-px">
                        Zapisz się
                    </x-ui.button>
                </form>
            </div>
        </div>

        <p
            class="mt-10 border-t border-slate-200/70 pt-6 text-xs text-slate-500 dark:border-slate-800 dark:text-slate-500">
            © 2026 Ostrowski Fizjoterapia. Wszelkie prawa zastrzeżone.
        </p>
    </div>
</footer>
