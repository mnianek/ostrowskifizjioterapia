@props([
    'tone' => 'brand',
])

@php
    $tones = [
        'brand' =>
            'bg-brand-100 text-brand-700 ring-brand-200 dark:bg-brand-500/20 dark:text-brand-200 dark:ring-brand-400/25',
        'secondary' => 'bg-secondary-500/15 text-secondary-500 ring-secondary-500/20',
        'accent' => 'bg-accent-500/15 text-amber-700 ring-amber-500/25 dark:text-amber-300',
    ];
@endphp

<span
    {{ $attributes->class("inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 {$tones[$tone]}") }}>
    {{ $slot }}
</span>
