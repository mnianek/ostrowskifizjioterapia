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
            'bg-ink text-paper shadow-sm hover:-translate-y-0.5 hover:bg-ink/90 hover:shadow-lg focus-visible:ring-sage/30',
        'secondary' =>
            'border border-ink/15 bg-paper/80 text-ink hover:-translate-y-0.5 hover:border-sage/50 focus-visible:ring-sage/25 dark:border-paper/15 dark:bg-paper/5 dark:text-paper',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->class("{$base} {$sizes[$size]} {$variants[$variant]}") }}>
    {{ $slot }}
</button>
