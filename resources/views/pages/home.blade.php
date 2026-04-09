<x-layout>
    <main class="relative">
        <section class="relative min-h-[100svh] overflow-hidden">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -left-24 -top-24 h-80 w-80 rounded-full bg-sage/20 blur-3xl dark:bg-sage/15">
                </div>
                <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-ink/10 blur-3xl dark:bg-paper/10">
                </div>
            </div>

            <div
                class="mx-auto grid max-w-7xl gap-10 px-4 pb-12 pt-10 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:items-end lg:px-8 lg:pb-16 lg:pt-14">
                <div class="relative">
                    <div class="reveal" data-reveal>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/65 dark:text-paper/70">
                            Modern Zen & Medical Excellence
                        </p>
                        <h1 class="mt-4 text-ink dark:text-paper">
                            Fizjoterapia, która wygląda jak spokój. Działa jak precyzja.
                        </h1>
                        <p class="lead mt-6 max-w-xl text-ink/70 dark:text-paper/70">
                            Diagnostyka, terapia manualna i plan ruchowy w jednym, spokojnym procesie — bez chaosu, z
                            mierzalnym postępem.
                        </p>
                    </div>

                    <div class="reveal mt-8 flex flex-wrap items-center gap-3" data-reveal>
                        <a href="{{ route('pages.contact') }}" class="btn-primary">
                            Umów konsultację
                        </a>
                        <a href="{{ route('posts.index') }}" class="btn-secondary">
                            Czytaj artykuły
                        </a>
                        <a href="#services" class="btn-quiet">
                            Zakres terapii
                        </a>
                    </div>

                    <div class="reveal mt-10 grid max-w-xl grid-cols-3 gap-3" data-reveal>
                        <div class="surface-glass p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">400+</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Pacjentów rocznie
                            </p>
                        </div>
                        <div class="surface-glass p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">12 lat</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Doświadczenia
                            </p>
                        </div>
                        <div class="surface-glass p-4 text-center">
                            <p class="text-lg font-semibold text-ink dark:text-paper">4.9/5</p>
                            <p
                                class="mt-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Średnia opinii
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="reveal surface-glass overflow-hidden p-3" data-reveal data-reveal-once="true">
                        <div class="relative overflow-hidden rounded-3xl">
                            <img src="{{ asset('images/LOGO%20BLACK.png') }}" alt=""
                                class="hero-logo pointer-events-none absolute left-6 top-6 h-10 w-auto dark:hidden"
                                data-hero-logo loading="eager" decoding="async" width="640" height="220">
                            <img src="{{ asset('images/LOGO%20WHITE.png') }}" alt=""
                                class="hero-logo pointer-events-none absolute left-6 top-6 hidden h-10 w-auto dark:block"
                                data-hero-logo loading="eager" decoding="async" width="640" height="220">

                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=1400&q=80"
                                alt="Fizjoterapia w spokojnym, profesjonalnym środowisku"
                                class="h-[56svh] w-full rounded-3xl object-cover sm:h-[62svh] lg:h-[72svh]"
                                loading="eager" fetchpriority="high" decoding="async" width="1400" height="1050">
                            <div
                                class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/35 via-ink/0 to-ink/0 dark:from-ink/55">
                            </div>
                        </div>
                    </div>

                    <div class="reveal mt-4 flex flex-wrap items-center gap-2 text-xs" data-reveal>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-ink/10 bg-paper/60 px-4 py-2 font-semibold uppercase tracking-[0.18em] text-ink/70 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/70">
                            <span class="h-1.5 w-1.5 rounded-full bg-sage"></span>
                            Indywidualny plan
                        </span>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-ink/10 bg-paper/60 px-4 py-2 font-semibold uppercase tracking-[0.18em] text-ink/70 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/70">
                            <span class="h-1.5 w-1.5 rounded-full bg-sage"></span>
                            Diagnostyka ruchu
                        </span>
                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-ink/10 bg-paper/60 px-4 py-2 font-semibold uppercase tracking-[0.18em] text-ink/70 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/70">
                            <span class="h-1.5 w-1.5 rounded-full bg-sage"></span>
                            Powrót do aktywności
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
            <div class="reveal max-w-2xl" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                    Zakres terapii
                </p>
                <h2 class="mt-3 text-ink dark:text-paper">
                    Usługi w układzie bento — konkretnie, luksusowo, bez hałasu
                </h2>
                <p class="lead mt-4 text-ink/70 dark:text-paper/70">
                    Każda usługa jest częścią jednego systemu: diagnoza → precyzyjna terapia → ruch, który utrzymuje
                    efekt.
                </p>
            </div>

            <div class="mt-10 grid gap-4 md:grid-cols-12">
                <article class="reveal md:col-span-7" data-reveal>
                    <div
                        class="group surface-glass h-full p-8 transition duration-500 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(26,26,26,0.18)] dark:hover:shadow-none">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                            Konsultacja i diagnostyka
                        </p>
                        <h3 class="mt-4 text-ink dark:text-paper">Diagnoza funkcjonalna</h3>
                        <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                            Analiza ruchu, testy, rozmowa o obciążeniach i celu terapii — bez zgadywania, z jasnym
                            planem od
                            pierwszej wizyty.
                        </p>
                        <div class="mt-6 flex items-center gap-3">
                            <span
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-700 dark:text-sage-200">
                                45–60 min
                            </span>
                            <span class="h-1 w-1 rounded-full bg-sage/60"></span>
                            <span
                                class="text-xs font-semibold uppercase tracking-[0.18em] text-ink/55 dark:text-paper/60">
                                Plan działań
                            </span>
                        </div>
                    </div>
                </article>

                <article class="reveal md:col-span-5" data-reveal>
                    <div
                        class="group surface-glass h-full p-8 transition duration-500 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(26,26,26,0.18)] dark:hover:shadow-none">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                            Terapia manualna
                        </p>
                        <h3 class="mt-4 text-ink dark:text-paper">Przywracanie mobilności</h3>
                        <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                            Praca tkankowa i stawowa dobrana do diagnostyki — w tempie, które uspokaja układ nerwowy i
                            daje
                            odczuwalną ulgę.
                        </p>
                    </div>
                </article>

                <article class="reveal md:col-span-5" data-reveal>
                    <div
                        class="group surface-glass h-full p-8 transition duration-500 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(26,26,26,0.18)] dark:hover:shadow-none">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                            Ruch medyczny
                        </p>
                        <h3 class="mt-4 text-ink dark:text-paper">Ćwiczenia, które zostają</h3>
                        <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                            Prosty zestaw ćwiczeń na gabinet i dom — bez nadmiaru, z progresją i kontrolą obciążenia.
                        </p>
                    </div>
                </article>

                <article class="reveal md:col-span-7" data-reveal>
                    <div
                        class="group surface-glass h-full p-8 transition duration-500 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(26,26,26,0.18)] dark:hover:shadow-none">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                            Urazy i przeciążenia
                        </p>
                        <h3 class="mt-4 text-ink dark:text-paper">Powrót do sportu i pracy</h3>
                        <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                            Strategia powrotu do aktywności oparta na tolerancji obciążenia, monitoringu objawów i
                            budowaniu
                            pewności w ruchu.
                        </p>
                        <div class="mt-6 grid gap-3 sm:grid-cols-3">
                            <div
                                class="rounded-2xl border border-ink/10 bg-paper/50 px-4 py-3 dark:border-paper/10 dark:bg-paper/5">
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/60 dark:text-paper/60">
                                    Kręgosłup
                                </p>
                            </div>
                            <div
                                class="rounded-2xl border border-ink/10 bg-paper/50 px-4 py-3 dark:border-paper/10 dark:bg-paper/5">
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/60 dark:text-paper/60">
                                    Kolano / bark
                                </p>
                            </div>
                            <div
                                class="rounded-2xl border border-ink/10 bg-paper/50 px-4 py-3 dark:border-paper/10 dark:bg-paper/5">
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-[0.18em] text-ink/60 dark:text-paper/60">
                                    Bóle przeciążeniowe
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">
                <div class="reveal lg:col-span-5" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        Sygnatura pracy
                    </p>
                    <h2 class="mt-3 text-ink dark:text-paper">
                        Prosty proces. Spokojne tempo. Realny efekt.
                    </h2>
                    <p class="lead mt-4 text-ink/70 dark:text-paper/70">
                        Nie dokładamy „więcej” — wybieramy to, co działa. Dzięki temu terapia jest przewidywalna i łatwa
                        do
                        utrzymania.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="reveal surface-glass p-7" data-reveal>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">
                                01</p>
                            <h3 class="mt-3 text-ink dark:text-paper">Diagnoza</h3>
                            <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                Rozumiemy przyczynę, nie tylko objaw.
                            </p>
                        </div>
                        <div class="reveal surface-glass p-7" data-reveal>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">
                                02</p>
                            <h3 class="mt-3 text-ink dark:text-paper">Plan</h3>
                            <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                Konkretny program na gabinet i dom.
                            </p>
                        </div>
                        <div class="reveal surface-glass p-7" data-reveal>
                            <p
                                class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/55 dark:text-paper/60">
                                03</p>
                            <h3 class="mt-3 text-ink dark:text-paper">Powrót</h3>
                            <p class="mt-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                Stabilny progres bez przeciążenia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
            <div class="reveal mx-auto max-w-2xl text-center" data-reveal>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                    Social proof
                </p>
                <h2 class="mt-3 text-ink dark:text-paper">Pacjenci wracają do życia bez bólu</h2>
            </div>

            <div class="mt-10 grid gap-4 md:grid-cols-3">
                <div class="reveal" data-reveal>
                    <x-ui.testimonial-card
                        quote="Po 6 tygodniach terapii wróciłam do treningów bez bólu pleców. Konkretne ćwiczenia i jasny plan."
                        author="Anna K." role="Biegaczka amatorska" />
                </div>
                <div class="reveal" data-reveal>
                    <x-ui.testimonial-card
                        quote="Najbardziej doceniam to, że od razu wiedziałem, co robić między wizytami. Efekt był szybszy niż wcześniej."
                        author="Marek R." role="Praca biurowa" />
                </div>
                <div class="reveal" data-reveal>
                    <x-ui.testimonial-card
                        quote="Profesjonalne podejście, zero chaosu i świetna komunikacja. Czuję się pewnie podczas powrotu do sportu."
                        author="Joanna P." role="Crossfit" />
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-18">
            <div class="reveal flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        Najnowsze wpisy
                    </p>
                    <h2 class="mt-3 text-ink dark:text-paper">Czytaj jak magazyn medyczny</h2>
                    <p class="mt-4 text-sm leading-7 text-ink/70 dark:text-paper/70">
                        Dużo światła, prosta hierarchia i konkret. Zapisz się do newslettera lub wróć tu co tydzień.
                    </p>
                </div>
                <a href="{{ route('posts.index') }}" class="btn-secondary self-start">
                    Zobacz wszystkie wpisy
                </a>
            </div>

            <div class="mt-10 grid gap-4 md:grid-cols-12">
                @forelse ($latestPosts as $post)
                    @php
                        $featuredImageUrl =
                            $post->getFirstMediaUrl('featured_image') ?:
                            ($post->image_path || $post->photo
                                ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                                : null);
                    @endphp

                    <article class="reveal md:col-span-4" data-reveal>
                        <a href="{{ route('posts.show', $post->slug) }}"
                            class="group block h-full overflow-hidden rounded-3xl border border-ink/10 bg-paper/70 transition duration-500 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(26,26,26,0.16)] dark:border-paper/10 dark:bg-paper/5 dark:hover:shadow-none">
                            <div class="relative h-56 overflow-hidden bg-paper-200 dark:bg-paper/10">
                                @if ($featuredImageUrl)
                                    <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}"
                                        class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                        loading="lazy" decoding="async" width="1200" height="900">
                                @else
                                    <div
                                        class="flex h-full items-center justify-center bg-linear-to-br from-paper-200 to-paper-400 text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:from-paper/10 dark:to-paper/5 dark:text-paper/60">
                                        <x-brand.logo size="h-12" :linked="false" />
                                    </div>
                                @endif
                                <div
                                    class="pointer-events-none absolute inset-0 bg-linear-to-t from-ink/35 via-ink/0 to-ink/0 dark:from-ink/55">
                                </div>
                            </div>

                            <div class="p-7">
                                <p
                                    class="text-[11px] font-semibold uppercase tracking-[0.22em] text-sage-700 dark:text-sage-200">
                                    {{ $post->category?->name ?? 'Bez kategorii' }}
                                </p>
                                <h3
                                    class="mt-3 text-ink transition group-hover:text-ink/85 dark:text-paper dark:group-hover:text-paper/85">
                                    {{ $post->title }}
                                </h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-7 text-ink/70 dark:text-paper/70">
                                    {{ $post->excerpt ?: $post->lead }}
                                </p>
                            </div>
                        </a>
                    </article>
                @empty
                    <p class="text-ink/70 dark:text-paper/70">Brak opublikowanych wpisów.</p>
                @endforelse
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 pt-6 sm:px-6 lg:px-8 lg:pb-22">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-start">
                <div class="reveal lg:col-span-5" data-reveal>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">
                        FAQ
                    </p>
                    <h2 class="mt-3 text-ink dark:text-paper">Spokojne odpowiedzi przed pierwszą wizytą</h2>
                    <p class="lead mt-4 text-ink/70 dark:text-paper/70">
                        Najczęściej pacjenci pytają o przebieg konsultacji, czas terapii i to, co robić pomiędzy
                        wizytami.
                    </p>
                </div>

                <div class="lg:col-span-7">
                    <div class="space-y-3">
                        @forelse ($faqs as $faq)
                            <div x-data="{ open: false }" class="reveal" data-reveal>
                                <div class="surface-glass overflow-hidden">
                                    <button type="button" @click="open = !open"
                                        class="flex w-full items-start justify-between gap-6 px-6 py-5 text-left">
                                        <span class="text-base font-semibold text-ink dark:text-paper">
                                            {{ $faq->question }}
                                        </span>
                                        <span
                                            class="mt-0.5 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-ink/10 bg-paper/60 text-ink/80 transition dark:border-paper/10 dark:bg-paper/5 dark:text-paper/80"
                                            aria-hidden="true">
                                            <span x-cloak x-show="!open">+</span>
                                            <span x-cloak x-show="open">—</span>
                                        </span>
                                    </button>

                                    <div x-cloak x-show="open" x-transition.opacity.duration.250ms
                                        class="border-t border-ink/10 px-6 pb-6 pt-4 text-sm leading-7 text-ink/70 dark:border-paper/10 dark:text-paper/70">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-ink/70 dark:text-paper/70">
                                Sekcja FAQ pojawi się po dodaniu pierwszych pytań w panelu.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8 lg:pb-24">
            <div class="reveal relative surface-ink overflow-hidden p-9 sm:p-12" data-reveal>
                <div class="pointer-events-none absolute inset-0 opacity-60">
                    <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-sage/25 blur-3xl"></div>
                    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-paper/10 blur-3xl"></div>
                </div>

                <div class="relative grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-paper/70">
                            Gotowy na pierwszy krok?
                        </p>
                        <h2 class="mt-4 text-paper">
                            Umów konsultację i odbierz indywidualny plan terapii
                        </h2>
                        <p class="mt-5 max-w-2xl text-sm leading-7 text-paper/75">
                            Pierwsze spotkanie skupia się na celu, przyczynie problemu i planie działań na najbliższe
                            tygodnie. Bez pośpiechu — z precyzją.
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 lg:justify-end">
                        <a href="{{ route('pages.contact') }}"
                            class="btn bg-paper text-ink shadow-sm shadow-ink/25 hover:-translate-y-0.5 hover:bg-paper/90">
                            Skontaktuj się
                        </a>
                        <a href="{{ route('posts.index') }}" class="btn-secondary">
                            Zobacz blog
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layout>
