@props([
    'metaTitle' => config('app.name') . ' - Fizjoterapia',
    'metaDescription' => 'Blog i poradniki o fizjoterapii, profilaktyce urazow i bezpiecznym powrocie do aktywnosci.',
    'canonical' => url()->current(),
    'ogImage' => asset('images/LOGO%20BLACK.png'),
    'ogType' => 'website',
    'robots' => 'index,follow',
])

<!DOCTYPE html>
<html lang="pl" class="h-full bg-paper text-ink dark:bg-ink dark:text-paper">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="alternate" type="application/rss+xml" title="{{ config('app.name') }} RSS"
        href="{{ route('posts.feed') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:opsz,wght@5..120,500;5..120,600;5..120,700&display=swap"
        rel="stylesheet">

    <script>
        try {
            const storedTheme = localStorage.getItem('theme');
            const darkMode = storedTheme ? storedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)')
                .matches;

            document.documentElement.classList.toggle('dark', darkMode);
        } catch (error) {}
    </script>

    @vite(['resources/css/app.css'])
    @livewireStyles
    @stack('structured-data')
</head>

<body x-data="themeController"
    class="min-h-full bg-paper text-ink antialiased transition-colors duration-300 dark:bg-ink dark:text-paper">
    @include('partials.navigation')

    <div class="relative isolate">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-96 bg-[radial-gradient(ellipse_at_top,rgba(125,157,133,0.18),transparent_62%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(125,157,133,0.22),transparent_58%)]">
        </div>
        <div
            class="pointer-events-none absolute inset-x-0 top-32 -z-10 h-72 bg-[radial-gradient(ellipse_at_center,rgba(26,26,26,0.08),transparent_70%)] dark:bg-[radial-gradient(ellipse_at_center,rgba(249,247,242,0.06),transparent_68%)]">
        </div>
        {{ $slot }}
    </div>

    @include('partials.footer')

    @livewireScriptConfig
    @vite(['resources/js/app.js'])
</body>

</html>
