@props([
    'linked' => true,
    'alt' => 'Ostrowski Fizjoterapia',
    'size' => 'h-20',
])

@php
    $blackLogo = asset('images/LOGO%20BLACK.png');
    $whiteLogo = asset('images/LOGO%20WHITE.png');
@endphp

@if ($linked)
    <a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}
        aria-label="{{ $alt }}">
        <span class="sr-only">{{ $alt }}</span>
        <img src="{{ $blackLogo }}" alt="" class="{{ $size }} w-auto dark:hidden" loading="eager"
            decoding="async">
        <img src="{{ $whiteLogo }}" alt="" class="{{ $size }} hidden w-auto dark:block" loading="eager"
            decoding="async">
    </a>
@else
    <span {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }} aria-hidden="true">
        <img src="{{ $blackLogo }}" alt="" class="{{ $size }} w-auto dark:hidden" loading="eager"
            decoding="async">
        <img src="{{ $whiteLogo }}" alt="" class="{{ $size }} hidden w-auto dark:block"
            loading="eager" decoding="async">
    </span>
@endif
