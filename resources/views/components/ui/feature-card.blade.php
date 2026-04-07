@props(['title', 'description'])

<article
    {{ $attributes->class('group surface-card p-6 transition duration-200 hover:-translate-y-1 hover:shadow-glow') }}>
    <div
        class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-brand-100 text-brand-700 ring-1 ring-brand-200 dark:bg-brand-500/15 dark:text-brand-200 dark:ring-brand-400/30">
        {{ $icon ?? '' }}
    </div>
    <h3 class="mt-5 text-xl font-semibold text-slate-900 dark:text-white">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $description }}</p>
</article>
