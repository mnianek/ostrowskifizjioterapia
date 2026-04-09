<x-layout>
    <main class="relative">
        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-end">
                <div class="reveal" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        O mnie
                    </p>
                    <h1 class="mt-4 text-ink dark:text-paper">Fizjoterapia oparta na diagnozie i ruchu</h1>
                    <p class="lead mt-6 max-w-2xl text-ink/70 dark:text-paper/70">
                        Jestem fizjoterapeutą, który łączy doświadczenie kliniczne z podejściem opartym na dowodach.
                        Pracuję z pacjentami bólowymi, pourazowymi oraz sportowcami, aby przywrócić pełną funkcję i
                        komfort życia.
                    </p>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Każdą terapię rozpoczynam od szczegółowego wywiadu i testów funkcjonalnych. Dzięki temu plan
                        leczenia jest konkretny, mierzalny i dopasowany do celu pacjenta.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('pages.contact') }}" class="btn-primary">Umów konsultację</a>
                        <a href="{{ route('posts.index') }}" class="btn-secondary">Czytaj blog</a>
                    </div>
                </div>

                <div class="reveal" data-reveal>
                    <div class="surface-glass overflow-hidden p-3">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=900&q=80"
                                alt="Trening medyczny i fizjoterapia"
                                class="h-[44svh] w-full rounded-3xl object-cover sm:h-[54svh] lg:h-[62svh]">
                            <div
                                class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/35 via-ink/0 to-transparent dark:from-ink/55">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8 lg:pb-18">
            <div class="grid gap-4 md:grid-cols-3">
                <article class="reveal surface-glass p-7" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">01</p>
                    <h2 class="mt-3 text-ink dark:text-paper">Diagnoza</h2>
                    <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Szczegółowy wywiad i testy funkcjonalne, które pokazują przyczynę problemu.
                    </p>
                </article>

                <article class="reveal surface-glass p-7" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">02</p>
                    <h2 class="mt-3 text-ink dark:text-paper">Terapia</h2>
                    <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Działania manualne i ruchowe dobrane precyzyjnie do etapu gojenia i celu pacjenta.
                    </p>
                </article>

                <article class="reveal surface-glass p-7" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">03</p>
                    <h2 class="mt-3 text-ink dark:text-paper">Powrót</h2>
                    <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Plan utrzymania efektu: jasne ćwiczenia, progresja i bezpieczny powrót do aktywności.
                    </p>
                </article>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8 lg:pb-20">
            <div class="reveal surface-ink relative overflow-hidden p-8 sm:p-10" data-reveal>
                <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-sage/20 blur-3xl"></div>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-paper/70">Podejście</p>
                <h2 class="mt-3 text-paper">Spokojny proces. Konkretne decyzje. Mierzalny efekt.</h2>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-paper/75">
                    Priorytetem jest realna poprawa funkcji i jakości życia, a nie chwilowe maskowanie objawów.
                    Dlatego każda wizyta ma jasny cel i miejsce w całym planie terapii.
                </p>
                <div class="mt-8">
                    <a href="{{ route('pages.contact') }}" class="btn bg-paper text-ink hover:bg-paper/90">
                        Porozmawiajmy o Twoim planie
                    </a>
                </div>
            </div>
        </section>
    </main>
</x-layout>
