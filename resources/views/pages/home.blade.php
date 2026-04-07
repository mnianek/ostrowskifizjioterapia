<x-layout>
    <main class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-100">
        <section class="border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950">
            <div
                class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8 lg:py-20">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db] dark:text-sky-300">Gabinet
                        Fizjoterapii</p>
                    <h1 class="mt-4 text-4xl font-bold leading-tight text-slate-900 sm:text-5xl dark:text-white">
                        Wróć do sprawności z planem terapii dopasowanym do Ciebie
                    </h1>
                    <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                        Pracujemy z bólem kręgosłupa, urazami sportowymi i przeciążeniami dnia codziennego. Łączymy
                        terapię manualną, ruch i edukację, aby efekty były trwałe.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('pages.contact') }}"
                            class="inline-flex items-center rounded-lg bg-[#3498db] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2d83bd]">
                            Umów konsultację
                        </a>
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:border-[#3498db] hover:text-[#3498db] dark:border-slate-700 dark:text-slate-100 dark:hover:border-sky-400 dark:hover:text-sky-300">
                            Przejdź do bloga
                        </a>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-100 p-3 shadow-sm dark:bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1200&q=80"
                        alt="Fizjoterapeuta podczas pracy z pacjentem" class="h-full w-full rounded-xl object-cover">
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div
                class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-950">
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">O mnie</h2>
                <p class="mt-4 max-w-4xl text-slate-600 dark:text-slate-300">
                    Nazywam się Jakub Ostrowski i pomagam pacjentom wrócić do aktywności bez bólu. W terapii stawiam na
                    jasny plan, regularną kontrolę postępów i narzędzia, które można bezpiecznie wdrożyć również w domu.
                </p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4">
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Najnowsze wpisy</h2>
                <a href="{{ route('posts.index') }}"
                    class="text-sm font-semibold text-[#3498db] hover:text-[#2d83bd]">Zobacz wszystkie</a>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-3">
                @forelse ($latestPosts as $post)
                    <article
                        class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-slate-800 dark:bg-slate-950 dark:hover:shadow-lg">
                        <p class="text-xs font-semibold uppercase tracking-wide text-[#3498db] dark:text-sky-300">
                            {{ $post->category?->name ?? 'Bez kategorii' }}
                        </p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="hover:text-[#3498db]">{{ $post->title }}</a>
                        </h3>
                        <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ $post->excerpt ?: $post->lead }}
                        </p>
                    </article>
                @empty
                    <p class="text-slate-600 dark:text-slate-300">Brak opublikowanych wpisów.</p>
                @endforelse
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            <div
                class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-950 sm:p-10">
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db] dark:text-sky-300">FAQ
                    </p>
                    <h2 class="mt-3 text-3xl font-bold tracking-[-0.02em] text-slate-900 dark:text-white">Częste pytania
                    </h2>
                    <p class="mt-4 text-slate-600 dark:text-slate-300">
                        Rozwijaj sekcje poniżej, aby szybko znaleźć odpowiedzi na najczęstsze pytania przed pierwszą
                        wizytą.
                    </p>
                </div>

                <div class="mt-8 space-y-4">
                    @forelse ($faqs as $faq)
                        <div x-data="{ open: false }"
                            class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900">
                            <button type="button" @click="open = !open"
                                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left">
                                <span
                                    class="text-base font-semibold text-slate-900 dark:text-white">{{ $faq->question }}</span>
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-[#3498db] shadow-sm ring-1 ring-slate-200 transition dark:bg-slate-950 dark:ring-slate-700 dark:text-sky-300"
                                    aria-hidden="true">
                                    <span x-cloak x-show="!open">+</span>
                                    <span x-cloak x-show="open">−</span>
                                </span>
                            </button>

                            <div x-cloak x-show="open" x-transition.opacity.duration.200ms
                                class="border-t border-slate-200 px-5 py-4 text-sm leading-7 text-slate-600 dark:border-slate-800 dark:text-slate-300">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-600 dark:text-slate-300">Sekcja FAQ pojawi się po dodaniu
                            pierwszych pytań w panelu.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-layout>
