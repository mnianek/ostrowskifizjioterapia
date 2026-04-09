@props(['title', 'description'])

<article
    {{ $attributes->class('group surface-card p-6 transition duration-200 hover:-translate-y-1 hover:shadow-lg') }}>
    <div
        class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-sage/15 text-sage-800 ring-1 ring-sage/25 dark:bg-sage/20 dark:text-sage-100 dark:ring-sage/30">
        {{ $icon ?? '' }}
    </div>
    <h3 class="mt-5 text-xl font-semibold text-ink dark:text-paper">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-6 text-ink/70 dark:text-paper/70">{{ $description }}</p>
</article>
