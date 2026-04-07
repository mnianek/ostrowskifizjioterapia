<nav x-data="{ mobileOpen: false }" class="sticky top-0 z-50 px-3 pt-3 sm:px-5 sm:pt-4">
    <div
        class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-white/65 bg-white/78 px-3 py-2.5 shadow-sm shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/80 dark:bg-slate-900/70 sm:px-4">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
            <span
                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-brand-600 text-sm font-black text-white shadow-lg">OF</span>
            <span class="text-sm font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-base">Ostrowski
                Fizjoterapia</span>
        </a>

        <div class="hidden items-center gap-1.5 text-sm font-medium lg:flex">
            <a href="{{ route('home') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('home') ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-700 hover:bg-brand-50 hover:text-brand-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-white' }}">Start</a>
            <a href="{{ route('posts.index') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('posts.*') ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-700 hover:bg-brand-50 hover:text-brand-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-white' }}">Blog</a>
            <a href="{{ route('pages.about') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.about') ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-700 hover:bg-brand-50 hover:text-brand-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-white' }}">O
                mnie</a>
            <a href="{{ route('pages.youtube') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.youtube') ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-700 hover:bg-brand-50 hover:text-brand-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-white' }}">YouTube</a>
            <a href="{{ route('pages.contact') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.contact') ? 'bg-brand-600 text-white shadow-sm' : 'text-slate-700 hover:bg-brand-50 hover:text-brand-700 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-white' }}">Kontakt</a>

            <button type="button" @click="toggle()" aria-label="Przełącz tryb ciemny"
                class="ml-1 inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300/80 text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-300/35 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-slate-100">
                <span x-cloak x-show="!darkMode">
                    <x-heroicon-o-moon class="h-5 w-5" />
                </span>
                <span x-cloak x-show="darkMode">
                    <x-heroicon-o-sun class="h-5 w-5" />
                </span>
            </button>
        </div>

        <div class="flex items-center gap-2 lg:hidden">
            <button type="button" @click="toggle()" aria-label="Przełącz tryb ciemny"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300/80 text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                <span x-cloak x-show="!darkMode">
                    <x-heroicon-o-moon class="h-5 w-5" />
                </span>
                <span x-cloak x-show="darkMode">
                    <x-heroicon-o-sun class="h-5 w-5" />
                </span>
            </button>

            <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()"
                aria-controls="mobile-menu" aria-label="Otwórz menu"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-300/80 text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                <x-heroicon-o-bars-3 x-show="!mobileOpen" x-cloak class="h-5 w-5" />
                <x-heroicon-o-x-mark x-show="mobileOpen" x-cloak class="h-5 w-5" />
            </button>
        </div>
    </div>

    <div id="mobile-menu" x-cloak x-show="mobileOpen" @keydown.escape.window="mobileOpen = false"
        x-transition.opacity.duration.200ms
        class="mx-auto mt-2 max-w-7xl rounded-2xl border border-slate-200/80 bg-white/95 p-2 shadow-md backdrop-blur-xl dark:border-slate-700 dark:bg-slate-900/95 lg:hidden">
        <a href="{{ route('home') }}" @click="mobileOpen = false"
            class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}">Start</a>
        <a href="{{ route('posts.index') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('posts.*') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}">Blog</a>
        <a href="{{ route('pages.about') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.about') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}">O
            mnie</a>
        <a href="{{ route('pages.youtube') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.youtube') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}">YouTube</a>
        <a href="{{ route('pages.contact') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.contact') ? 'bg-brand-600 text-white' : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' }}">Kontakt</a>
    </div>
</nav>
