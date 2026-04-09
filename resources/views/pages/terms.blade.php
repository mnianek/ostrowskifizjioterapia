<x-layout metaTitle="Regulamin" metaDescription="Podstawowe zasady korzystania z serwisu.">
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <article class="surface-glass reveal p-6 sm:p-8 lg:p-10" data-reveal>
            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-ink/60 dark:text-paper/60">Dokument prawny
            </p>
            <h1 class="mt-3 text-ink dark:text-paper">Regulamin</h1>

            <div class="article-body mt-8 text-sm">
                <p>
                    Serwis ma charakter informacyjny. Treści publikowane na stronie nie stanowią indywidualnej porady
                    medycznej i nie zastępują konsultacji specjalistycznej.
                </p>

                <h2>Zasady korzystania</h2>
                <ul>
                    <li>Użytkownik zobowiązuje się korzystać z serwisu zgodnie z prawem i dobrymi obyczajami.</li>
                    <li>Zabronione jest dostarczanie treści bezprawnych, obraźliwych lub naruszających prawa innych
                        osób.</li>
                    <li>Administrator może moderować komentarze i usuwać treści naruszające zasady.</li>
                </ul>

                <h2>Kontakt</h2>
                <p>
                    W sprawach dotyczących działania serwisu skorzystaj z formularza na stronie Kontakt.
                </p>
            </div>

            <div class="mt-8 border-t border-ink/10 pt-6 dark:border-paper/10">
                <a href="{{ route('pages.contact') }}" class="btn-secondary">Przejdź do kontaktu</a>
            </div>
        </article>
    </main>
</x-layout>
