@props(['quote', 'author', 'role' => null])

<article {{ $attributes->class('surface-card p-6 sm:p-7') }}>
    <p class="text-sm leading-7 text-ink/85 dark:text-paper/85">&ldquo;{{ $quote }}&rdquo;</p>
    <div class="mt-5 flex items-center gap-3">
        <div
            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-sage/20 text-sm font-semibold text-sage-800 dark:bg-sage/25 dark:text-sage-100">
            {{ strtoupper(substr($author, 0, 1)) }}
        </div>
        <div>
            <p class="text-sm font-semibold text-ink dark:text-paper">{{ $author }}</p>
            @if ($role)
                <p class="text-xs text-ink/55 dark:text-paper/55">{{ $role }}</p>
            @endif
        </div>
    </div>
</article>
