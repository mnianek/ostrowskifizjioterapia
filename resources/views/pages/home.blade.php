<x-layout>
    <main class="text-slate-900 dark:text-slate-100">
        <x-ui.section size="lg">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                <div>
                    <x-ui.badge tone="brand">Nowoczesna opieka fizjoterapeutyczna</x-ui.badge>
                    <h1
                        class="mt-6 text-4xl font-bold leading-tight text-slate-900 sm:text-5xl lg:text-6xl dark:text-white">
                        Wracaj do sprawności szybciej z planem terapii skrojonym pod Ciebie
                    </h1>
                    <p class="mt-6 max-w-2xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                        Pracujemy z bólem kręgosłupa, urazami sportowymi i przeciążeniami dnia codziennego. Łączymy
                        terapię
                        manualną, ruch i edukację, aby efekt był trwały i mierzalny.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('pages.contact') }}" class="btn-primary">
                            Umów konsultację
                        </a>
                        <a href="{{ route('posts.index') }}" class="btn-secondary">
                            Przejdź do bloga
                        </a>
                    </div>
                    <div class="mt-8 grid max-w-xl grid-cols-3 gap-3 text-center">
                        <div class="surface-card p-3">
                            <p class="text-xl font-bold text-brand-600 dark:text-brand-300">400+</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Pacjentów rocznie</p>
                        </div>
                        <div class="surface-card p-3">
                            <p class="text-xl font-bold text-brand-600 dark:text-brand-300">12 lat</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Doświadczenia</p>
                        </div>
                        <div class="surface-card p-3">
                            <p class="text-xl font-bold text-brand-600 dark:text-brand-300">4.9/5</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Średnia opinii</p>
                        </div>
                    </div>
                </div>

                <div class="surface-card overflow-hidden p-3">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1200&q=80"
                        alt="Fizjoterapeuta podczas pracy z pacjentem" class="h-full w-full rounded-2xl object-cover">
                </div>
            </div>
        </x-ui.section>

        <x-ui.section id="features" size="md">
            <div class="mx-auto max-w-2xl text-center">
                <x-ui.badge tone="secondary">Dlaczego ten model pracy działa</x-ui.badge>
                <h2 class="mt-4 text-3xl font-bold text-slate-900 dark:text-white sm:text-4xl">Terapia oparta na
                    prostym,
                    skutecznym procesie</h2>
                <p class="mt-4 text-slate-600 dark:text-slate-300">Każdy etap jest zaprojektowany tak, aby zmniejszać
                    ból,
                    przywracać mobilność i budować nawyki, które utrzymają efekty.</p>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                <x-ui.feature-card title="Dokładna diagnoza"
                    description="Pierwsza konsultacja to analiza ruchu, przeciążeń i celu terapii. Dzięki temu plan jest konkretny od początku.">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.05 6.05a7.5 7.5 0 0 0 10.6 10.6Z" />
                        </svg>
                    </x-slot:icon>
                </x-ui.feature-card>

                <x-ui.feature-card title="Plan szyty na miarę"
                    description="Otrzymujesz jasny plan działań na gabinet i dom, dopasowany do stylu życia i poziomu aktywności.">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75m6 3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </x-slot:icon>
                </x-ui.feature-card>

                <x-ui.feature-card title="Stały monitoring postępu"
                    description="Regularnie mierzymy zmiany i korygujemy terapię, aby utrzymać tempo poprawy bez przeciążenia.">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3v18h18M7.5 15.75v-4.5m4.5 4.5V9m4.5 6.75V6.75" />
                        </svg>
                    </x-slot:icon>
                </x-ui.feature-card>
            </div>
        </x-ui.section>

        <x-ui.section id="testimonials" size="md">
            <div class="mx-auto max-w-2xl text-center">
                <x-ui.badge tone="accent">Opinie i social proof</x-ui.badge>
                <h2 class="mt-4 text-3xl font-bold text-slate-900 dark:text-white sm:text-4xl">Pacjenci wracają do życia
                    bez bólu</h2>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-3">
                <x-ui.testimonial-card
                    quote="Po 6 tygodniach terapii wróciłam do treningów bez bólu pleców. Konkretne ćwiczenia i jasny plan."
                    author="Anna K." role="Biegaczka amatorska" />
                <x-ui.testimonial-card
                    quote="Najbardziej doceniam to, że od razu wiedziałem, co robić między wizytami. Efekt był szybszy niż wcześniej."
                    author="Marek R." role="Praca biurowa" />
                <x-ui.testimonial-card
                    quote="Profesjonalne podejście, zero chaosu i świetna komunikacja. Czuję się pewnie podczas powrotu do sportu."
                    author="Joanna P." role="Crossfit" />
            </div>
        </x-ui.section>

        <x-ui.section size="sm">
            <div class="surface-card p-8 sm:p-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                    <div class="max-w-2xl">
                        <x-ui.badge tone="brand">Najnowsze wpisy</x-ui.badge>
                        <h2 class="mt-4 text-3xl font-bold text-slate-900 dark:text-white">Sprawdź aktualne artykuły o
                            zdrowym ruchu</h2>
                    </div>
                    <a href="{{ route('posts.index') }}" class="btn-secondary self-start">
                        Zobacz wszystkie wpisy
                    </a>
                </div>

                <div class="mt-8 grid gap-5 md:grid-cols-3">
                    @forelse ($latestPosts as $post)
                        <article
                            class="rounded-2xl border border-slate-200 bg-white p-6 transition duration-200 hover:-translate-y-1 hover:shadow-glow dark:border-slate-700 dark:bg-slate-900/80">
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.12em] text-brand-600 dark:text-brand-300">
                                {{ $post->category?->name ?? 'Bez kategorii' }}
                            </p>
                            <h3 class="mt-3 text-xl font-semibold text-slate-900 dark:text-white">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="transition hover:text-brand-600 dark:hover:text-brand-300">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
                                {{ $post->excerpt ?: $post->lead }}</p>
                        </article>
                    @empty
                        <p class="text-slate-600 dark:text-slate-300">Brak opublikowanych wpisów.</p>
                    @endforelse
                </div>
            </div>
        </x-ui.section>

        <x-ui.section size="sm">
            <div class="surface-card p-8 sm:p-10">
                <div class="max-w-2xl">
                    <x-ui.badge tone="brand">FAQ</x-ui.badge>
                    <h2 class="mt-4 text-3xl font-bold text-slate-900 dark:text-white">Częste pytania przed pierwszą
                        wizytą</h2>
                    <p class="mt-4 text-slate-600 dark:text-slate-300">Rozwiń odpowiedzi poniżej, aby szybko przygotować
                        się do konsultacji.</p>
                </div>

                <div class="mt-8 space-y-4">
                    @forelse ($faqs as $faq)
                        <div x-data="{ open: false }"
                            class="overflow-hidden rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900/80">
                            <button type="button" @click="open = !open"
                                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left">
                                <span
                                    class="text-base font-semibold text-slate-900 dark:text-white">{{ $faq->question }}</span>
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-brand-100 text-brand-700 ring-1 ring-brand-200 transition dark:bg-brand-500/20 dark:text-brand-300 dark:ring-brand-400/25"
                                    aria-hidden="true">
                                    <span x-cloak x-show="!open">+</span>
                                    <span x-cloak x-show="open">-</span>
                                </span>
                            </button>

                            <div x-cloak x-show="open" x-transition.opacity.duration.200ms
                                class="border-t border-slate-200 px-5 py-4 text-sm leading-7 text-slate-600 dark:border-slate-700 dark:text-slate-300">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-600 dark:text-slate-300">Sekcja FAQ pojawi się po dodaniu
                            pierwszych pytań w panelu.</p>
                    @endforelse
                </div>
            </div>
        </x-ui.section>

        <x-ui.section size="sm">
            <div class="rounded-3xl bg-brand-600 p-8 text-white shadow-glow sm:p-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-brand-100">Gotowy na pierwszy
                            krok?</p>
                        <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Umów konsultację i odbierz indywidualny plan
                            terapii</h2>
                        <p class="mt-4 text-brand-100">Pierwsze spotkanie skupia się na celu, przyczynie problemu i
                            planie działań na najbliższe tygodnie.</p>
                    </div>
                    <a href="{{ route('pages.contact') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-white px-6 py-3 text-sm font-semibold text-brand-700 transition hover:-translate-y-0.5 hover:bg-brand-50">
                        Skontaktuj się
                    </a>
                </div>
            </div>
        </x-ui.section>
    </main>
</x-layout>
