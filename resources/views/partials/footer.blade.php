<footer class="mt-16 border-t border-slate-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">Ostrowski Fizjoterapia</p>
                <p class="mt-2 text-sm text-slate-600">Terapia ruchem, edukacja i powrót do pełnej sprawności.</p>
            </div>
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="{{ route('home') }}" class="font-medium text-slate-600 transition hover:text-[#3498db]">Start</a>
                <a href="{{ route('posts.index') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db]">Blog</a>
                <a href="{{ route('pages.youtube') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db]">YouTube</a>
                <a href="{{ route('pages.contact') }}"
                    class="font-medium text-slate-600 transition hover:text-[#3498db]">Kontakt</a>
            </div>
        </div>
        <p class="mt-8 border-t border-slate-100 pt-6 text-xs text-slate-500">© 2026 Ostrowski Fizjoterapia. Wszelkie
            prawa zastrzeżone.</p>
    </div>
</footer>
