@props([
    'id' => null,
    'size' => 'lg',
])

@php
    $spacings = [
        'sm' => 'py-10 sm:py-12',
        'md' => 'py-12 sm:py-16',
        'lg' => 'py-14 sm:py-20',
    ];
@endphp

<section @if ($id) id="{{ $id }}" @endif {{ $attributes->class($spacings[$size]) }}>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</section>
