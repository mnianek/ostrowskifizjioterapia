@props([
    'tone' => 'brand',
])

@php
    $tones = [
        'brand' =>
            'bg-sage/15 text-sage-800 ring-sage/25 dark:bg-sage/20 dark:text-sage-100 dark:ring-sage/30',
        'secondary' => 'bg-sage/10 text-sage-700 ring-sage/20 dark:text-sage-200 dark:ring-sage/25',
        'accent' => 'bg-paper-300/80 text-ink/80 ring-ink/10 dark:bg-paper/10 dark:text-paper/85 dark:ring-paper/15',
    ];
@endphp

<span
    {{ $attributes->class("inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 {$tones[$tone]}") }}>
    {{ $slot }}
</span>
