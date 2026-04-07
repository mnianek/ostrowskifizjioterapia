@props(['quote', 'author', 'role' => null])

<article {{ $attributes->class('surface-card p-6 sm:p-7') }}>
    <p class="text-sm leading-7 text-slate-700 dark:text-slate-200">&ldquo;{{ $quote }}&rdquo;</p>
    <div class="mt-5 flex items-center gap-3">
        <div
            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700 dark:bg-brand-500/20 dark:text-brand-200">
            {{ strtoupper(substr($author, 0, 1)) }}
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $author }}</p>
            @if ($role)
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $role }}</p>
            @endif
        </div>
    </div>
</article>
