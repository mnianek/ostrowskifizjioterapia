<x-layout>
    <main class="bg-slate-50">
        <section class="border-b border-slate-200 bg-white">
            <div
                class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8 lg:py-20">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#3498db]">Gabinet Fizjoterapii</p>
                    <h1 class="mt-4 text-4xl font-bold leading-tight text-slate-900 sm:text-5xl">
                        Wróć do sprawności z planem terapii dopasowanym do Ciebie
                    </h1>
                    <p class="mt-6 max-w-xl text-lg leading-relaxed text-slate-600">
                        Pracujemy z bólem kręgosłupa, urazami sportowymi i przeciążeniami dnia codziennego. Łączymy
                        terapię manualną, ruch i edukację, aby efekty były trwałe.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('pages.contact') }}"
                            class="inline-flex items-center rounded-lg bg-[#3498db] px-5 py-3 text-sm font-semibold text-white hover:bg-[#2d83bd]">
                            Umów konsultację
                        </a>
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center rounded-lg border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:border-[#3498db] hover:text-[#3498db]">
                            Przejdź do bloga
                        </a>
                    </div>
                </div>
                <div class="rounded-2xl bg-slate-100 p-3 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1200&q=80"
                        alt="Fizjoterapeuta podczas pracy z pacjentem" class="h-full w-full rounded-xl object-cover">
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">O mnie</h2>
                <p class="mt-4 max-w-4xl text-slate-600">
                    Nazywam się Jakub Ostrowski i pomagam pacjentom wrócić do aktywności bez bólu. W terapii stawiam na
                    jasny plan, regularną kontrolę postępów i narzędzia, które można bezpiecznie wdrożyć również w domu.
                </p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between gap-4">
                <h2 class="text-2xl font-semibold text-slate-900">Najnowsze wpisy</h2>
                <a href="{{ route('posts.index') }}"
                    class="text-sm font-semibold text-[#3498db] hover:text-[#2d83bd]">Zobacz wszystkie</a>
            </div>
            <div class="mt-6 grid gap-6 md:grid-cols-3">
                @forelse ($latestPosts as $post)
                    <article
                        class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <p class="text-xs font-semibold uppercase tracking-wide text-[#3498db]">
                            {{ $post->category?->name ?? 'Bez kategorii' }}
                        </p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="hover:text-[#3498db]">{{ $post->title }}</a>
                        </h3>
                        <p class="mt-3 text-sm text-slate-600">{{ $post->excerpt ?: $post->lead }}</p>
                    </article>
                @empty
                    <p class="text-slate-600">Brak opublikowanych wpisów.</p>
                @endforelse
            </div>
        </section>
    </main>
</x-layout>
