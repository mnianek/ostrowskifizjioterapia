@if ($paginator->hasPages())
    <nav class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between" aria-label="Paginacja">
        <div class="text-sm text-ink/55 dark:text-paper/55">
            Strona {{ $paginator->currentPage() }} z {{ $paginator->lastPage() }}
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex items-center rounded-2xl border border-ink/10 bg-paper/60 px-4 py-2 text-sm font-semibold text-ink/35 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/35">
                    Poprzednia
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="inline-flex items-center rounded-2xl border border-ink/10 bg-paper/70 px-4 py-2 text-sm font-semibold text-ink transition hover:border-sage/50 dark:border-paper/10 dark:bg-paper/5 dark:text-paper">
                    Poprzednia
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-sm text-ink/40 dark:text-paper/40">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="inline-flex min-w-10 items-center justify-center rounded-2xl border border-sage/40 bg-sage/15 px-3.5 py-2 text-sm font-semibold text-sage-900 dark:border-sage/30 dark:bg-sage/20 dark:text-sage-100">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="inline-flex min-w-10 items-center justify-center rounded-2xl border border-ink/10 bg-paper/70 px-3.5 py-2 text-sm font-semibold text-ink/80 transition hover:border-sage/40 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/80">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="inline-flex items-center rounded-2xl border border-ink/10 bg-paper/70 px-4 py-2 text-sm font-semibold text-ink transition hover:border-sage/50 dark:border-paper/10 dark:bg-paper/5 dark:text-paper">
                    Następna
                </a>
            @else
                <span
                    class="inline-flex items-center rounded-2xl border border-ink/10 bg-paper/60 px-4 py-2 text-sm font-semibold text-ink/35 dark:border-paper/10 dark:bg-paper/5 dark:text-paper/35">
                    Następna
                </span>
            @endif
        </div>
    </nav>
@endif
