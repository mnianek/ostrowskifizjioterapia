@php
    $linkInactive =
        'text-ink/80 hover:bg-paper/80 hover:text-ink dark:text-paper/85 dark:hover:bg-paper/10 dark:hover:text-paper';
    $linkActive = 'bg-ink text-paper shadow-sm dark:bg-paper dark:text-ink';
@endphp

<nav x-data="{ mobileOpen: false }" class="sticky top-0 z-50 px-3 pt-3 sm:px-5 sm:pt-4">
    <div
        class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-ink/10 bg-paper/75 px-3 py-2.5 shadow-sm shadow-ink/5 backdrop-blur-xl dark:border-paper/10 dark:bg-paper/10 sm:px-4">
        <x-brand.logo class="max-w-72 shrink-0 origin-left scale-110 sm:scale-125" size="h-10 sm:h-11" />

        <div class="hidden items-center gap-1.5 text-sm font-medium lg:flex">
            <a href="{{ route('home') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('home') ? $linkActive : $linkInactive }}">Start</a>
            <a href="{{ route('posts.index') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('posts.*') ? $linkActive : $linkInactive }}">Blog</a>
            <a href="{{ route('pages.about') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.about') ? $linkActive : $linkInactive }}">O
                mnie</a>
            <a href="{{ route('pages.youtube') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.youtube') ? $linkActive : $linkInactive }}">YouTube</a>
            <a href="{{ route('pages.contact') }}"
                class="rounded-lg px-3 py-2 transition {{ request()->routeIs('pages.contact') ? $linkActive : $linkInactive }}">Kontakt</a>

            <button type="button" @click="toggle()" aria-label="Przełącz tryb ciemny"
                class="ml-1 inline-flex h-10 w-10 items-center justify-center rounded-lg border border-ink/15 text-ink transition hover:bg-paper/80 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-sage/25 dark:border-paper/15 dark:text-paper dark:hover:bg-paper/10">
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
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-ink/15 text-ink transition hover:bg-paper/80 dark:border-paper/15 dark:text-paper dark:hover:bg-paper/10">
                <span x-cloak x-show="!darkMode">
                    <x-heroicon-o-moon class="h-5 w-5" />
                </span>
                <span x-cloak x-show="darkMode">
                    <x-heroicon-o-sun class="h-5 w-5" />
                </span>
            </button>

            <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()"
                aria-controls="mobile-menu" aria-label="Otwórz menu"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-ink/15 text-ink transition hover:bg-paper/80 dark:border-paper/15 dark:text-paper dark:hover:bg-paper/10">
                <x-heroicon-o-bars-3 x-show="!mobileOpen" x-cloak class="h-5 w-5" />
                <x-heroicon-o-x-mark x-show="mobileOpen" x-cloak class="h-5 w-5" />
            </button>
        </div>
    </div>

    <div id="mobile-menu" x-cloak x-show="mobileOpen" @keydown.escape.window="mobileOpen = false"
        x-transition.opacity.duration.200ms
        class="mx-auto mt-2 max-w-7xl rounded-2xl border border-ink/10 bg-paper/95 p-2 shadow-md backdrop-blur-xl dark:border-paper/10 dark:bg-paper/10 lg:hidden">
        <a href="{{ route('home') }}" @click="mobileOpen = false"
            class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? $linkActive : $linkInactive }}">Start</a>
        <a href="{{ route('posts.index') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('posts.*') ? $linkActive : $linkInactive }}">Blog</a>
        <a href="{{ route('pages.about') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.about') ? $linkActive : $linkInactive }}">O
            mnie</a>
        <a href="{{ route('pages.youtube') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.youtube') ? $linkActive : $linkInactive }}">YouTube</a>
        <a href="{{ route('pages.contact') }}" @click="mobileOpen = false"
            class="mt-1 block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('pages.contact') ? $linkActive : $linkInactive }}">Kontakt</a>
    </div>
</nav>
