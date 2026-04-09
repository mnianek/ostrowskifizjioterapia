<x-layout>
    <main class="relative">
        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
                <div class="reveal" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        O mnie
                    </p>
                    <h1 class="mt-4 text-ink dark:text-paper">Kim jestem i jak pracuję z pacjentem</h1>
                    <p class="lead mt-6 max-w-2xl text-ink/70 dark:text-paper/70">
                        Jestem fizjoterapeutą, który łączy doświadczenie kliniczne z podejściem opartym na dowodach.
                        Pracuję z pacjentami bólowymi, pourazowymi oraz sportowcami, aby przywrócić pełną funkcję i
                        komfort życia.
                    </p>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Każdą terapię rozpoczynam od szczegółowego wywiadu i testów funkcjonalnych. Dzięki temu plan
                        leczenia jest konkretny, mierzalny i dopasowany do celu pacjenta.
                    </p>

                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <div class="surface-card p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">12+ lat</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Doświadczenia
                            </p>
                        </div>
                        <div class="surface-card p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">Manual + ruch</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Styl terapii
                            </p>
                        </div>
                        <div class="surface-card p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">Plan 1:1</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Dla każdego pacjenta
                            </p>
                        </div>
                    </div>
                </div>

                <div class="reveal" data-reveal>
                    <div class="surface-glass overflow-hidden p-3">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=900&q=80"
                                alt="Trening medyczny i fizjoterapia"
                                class="h-[44svh] w-full rounded-3xl object-cover sm:h-[54svh] lg:h-[62svh]"
                                loading="eager" fetchpriority="high" decoding="async" width="900" height="1200">
                            <div
                                class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/35 via-ink/0 to-transparent dark:from-ink/55">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8 lg:pb-18">
            <div class="grid gap-4 lg:grid-cols-2">
                <article class="reveal surface-glass p-7 sm:p-8" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">Jak
                        pracuję</p>
                    <h2 class="mt-3 text-ink dark:text-paper">Spokojnie, konkretnie i etapami</h2>
                    <ul class="mt-5 space-y-3 text-sm leading-7 text-ink/75 dark:text-paper/75">
                        <li>Najpierw diagnoza funkcjonalna i zrozumienie źródła objawu.</li>
                        <li>Potem precyzyjna terapia manualna i trening medyczny.</li>
                        <li>Na końcu plan samodzielnej pracy, który utrwala efekt.</li>
                    </ul>
                </article>

                <article class="reveal surface-glass p-7 sm:p-8" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">Z kim
                        pracuję</p>
                    <h2 class="mt-3 text-ink dark:text-paper">Pacjenci bólowi, pourazowi, aktywni</h2>
                    <ul class="mt-5 space-y-3 text-sm leading-7 text-ink/75 dark:text-paper/75">
                        <li>Bóle kręgosłupa, barku, kolana i przeciążenia dnia codziennego.</li>
                        <li>Powrót do sportu po urazach i zabiegach.</li>
                        <li>Profilaktyka nawrotów i poprawa jakości ruchu.</li>
                    </ul>
                </article>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-14 sm:px-6 lg:px-8 lg:pb-20">
            <div class="reveal surface-ink relative overflow-hidden p-8 sm:p-10" data-reveal>
                <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-sage/20 blur-3xl">
                </div>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-paper/70">Współpraca</p>
                <h2 class="mt-3 text-paper">Masz cel terapeutyczny? Ułożymy plan krok po kroku.</h2>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-paper/75">
                    Jeśli chcesz wrócić do sprawności po bólu lub urazie, przygotuję dla Ciebie plan
                    dopasowany do obciążeń, stylu życia i aktualnych możliwości.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('pages.contact') }}" class="btn bg-paper text-ink hover:bg-paper/90">
                        Umów konsultację
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="btn border border-paper/35 text-paper hover:bg-paper/10">
                        Zobacz artykuły
                    </a>
                </div>
            </div>
        </section>
    </main>
</x-layout>
