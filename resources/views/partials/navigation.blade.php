<nav class="border-b border-slate-800 bg-[#0B1A2A] text-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 flex-wrap items-center justify-between gap-3 py-3">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <span
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-[#3498db] text-sm font-black text-white">OF</span>
                <span class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-100">Ostrowski
                    Fizjoterapia</span>
            </a>

            <div class="flex flex-wrap items-center gap-1 text-sm font-medium">
                <a href="{{ route('home') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('home') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    Start
                </a>
                <a href="{{ route('posts.index') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('posts.*') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    Blog
                </a>
                <a href="{{ route('pages.about') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.about') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    O mnie
                </a>
                <a href="{{ route('pages.youtube') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.youtube') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    YouTube
                </a>
                <a href="{{ route('pages.contact') }}"
                    class="rounded-md px-3 py-2 transition {{ request()->routeIs('pages.contact') ? 'bg-[#3498db] text-white' : 'text-slate-200 hover:bg-slate-800 hover:text-white' }}">
                    Kontakt
                </a>
            </div>
        </div>
    </div>
</nav>
