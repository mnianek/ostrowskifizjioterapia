<footer class="mt-16 border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-slate-500 dark:text-slate-400">Ostrowski
                    Fizjoterapia</p>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">Terapia ruchem, edukacja i powrót do pełnej
                    sprawności.</p>
            </div>
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="{{ route('home') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db] dark:text-slate-400 dark:hover:text-sky-300">Start</a>
                <a href="{{ route('posts.index') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db] dark:text-slate-400 dark:hover:text-sky-300">Blog</a>
                <a href="{{ route('pages.youtube') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db] dark:text-slate-400 dark:hover:text-sky-300">YouTube</a>
                <a href="{{ route('pages.contact') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db] dark:text-slate-400 dark:hover:text-sky-300">Kontakt</a>
            </div>
        </div>

        @if (session('newsletter_status'))
            <div
                class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">
                {{ session('newsletter_status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('newsletter.subscribe') }}"
            class="mt-6 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-900 sm:flex-row sm:items-end">
            @csrf

            <label class="flex-1">
                <span
                    class="mb-2 block text-xs font-semibold uppercase tracking-[0.14em] text-slate-500 dark:text-slate-400">Newsletter</span>
                <input type="email" name="email" value="{{ old('email') }}" required
                    placeholder="Twój adres e-mail"
                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#3498db] focus:ring-4 focus:ring-[#3498db]/15 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-sky-400 dark:focus:ring-sky-400/15">
                @error('email')
                    <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </label>

            <button type="submit"
                class="inline-flex items-center justify-center rounded-2xl bg-[#3498db] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#2d83bd] hover:shadow-lg">
                Zapisz się
            </button>
        </form>

        <p class="mt-8 border-t border-slate-100 pt-6 text-xs text-slate-500 dark:border-slate-800 dark:text-slate-500">
            © 2026 Ostrowski Fizjoterapia. Wszelkie
            prawa zastrzeżone.</p>
    </div>
</footer>
