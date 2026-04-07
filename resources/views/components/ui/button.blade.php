@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
])

@php
    $base =
        'inline-flex items-center justify-center rounded-xl font-semibold transition duration-200 focus-visible:outline-none focus-visible:ring-4 disabled:cursor-not-allowed disabled:opacity-60';

    $sizes = [
        'sm' => 'px-4 py-2 text-xs',
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-6 py-3.5 text-base',
    ];

    $variants = [
        'primary' =>
            'bg-brand-600 text-white shadow-sm hover:-translate-y-0.5 hover:bg-brand-500 hover:shadow-lg focus-visible:ring-brand-300/40',
        'secondary' =>
            'border border-slate-300 bg-white/90 text-slate-700 hover:-translate-y-0.5 hover:border-brand-300 hover:text-brand-700 focus-visible:ring-brand-300/30 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:hover:border-brand-400 dark:hover:text-brand-200',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->class("{$base} {$sizes[$size]} {$variants[$variant]}") }}>
    {{ $slot }}
</button>
