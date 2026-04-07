<nav class="border-b border-slate-800 bg-[#0B1A2A] text-white shadow-sm dark:border-slate-700 dark:bg-slate-950">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 flex-wrap items-center justify-between gap-3 py-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-[#3498db] text-sm font-black text-white">OF</span>
                <span
                    class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-100 dark:text-slate-50">Ostrowski
                    Fizjoterapia</span>
            </a>

            <div class="flex flex-wrap items-center gap-1 text-sm font-medium">
                <a href="{{ route('home') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('home') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white dark:text-slate-300 dark:hover:bg-slate-800/80' }}">
                    Start
                </a>
                <a href="{{ route('posts.index') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('posts.*') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white dark:text-slate-300 dark:hover:bg-slate-800/80' }}">
                    Blog
                </a>
                <a href="{{ route('pages.about') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.about') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white dark:text-slate-300 dark:hover:bg-slate-800/80' }}">
                    O mnie
                </a>
                <a href="{{ route('pages.youtube') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.youtube') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white dark:text-slate-300 dark:hover:bg-slate-800/80' }}">
                    YouTube
                </a>
                <a href="{{ route('pages.contact') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.contact') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white dark:text-slate-300 dark:hover:bg-slate-800/80' }}">
                    Kontakt
                </a>

                <button type="button" @click="toggle()" aria-label="Przełącz tryb ciemny"
                    class="ml-1 inline-flex h-10 w-10 items-center justify-center rounded-md border border-white/10 text-slate-200 transition hover:bg-white/10 hover:text-white dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                    <span x-cloak x-show="!darkMode">
                        <x-heroicon-o-moon class="h-5 w-5" />
                    </span>
                    <span x-cloak x-show="darkMode">
                        <x-heroicon-o-sun class="h-5 w-5" />
                    </span>
                </button>
            </div>
        </div>
    </div>
</nav>
