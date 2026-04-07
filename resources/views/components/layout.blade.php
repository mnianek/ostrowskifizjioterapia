<!DOCTYPE html>
<html lang="pl" class="h-full bg-slate-50 dark:bg-slate-950">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Fizjoterapia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap"
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
</head>

<body x-data="themeController"
    class="min-h-full bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">
    @include('partials.navigation')

    <div class="relative isolate">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-96 bg-[radial-gradient(ellipse_at_top,rgba(30,64,175,0.18),transparent_62%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(68,110,241,0.26),transparent_58%)]">
        </div>
        <div
            class="pointer-events-none absolute inset-x-0 top-32 -z-10 h-72 bg-[radial-gradient(ellipse_at_center,rgba(14,165,164,0.13),transparent_70%)] dark:bg-[radial-gradient(ellipse_at_center,rgba(14,165,164,0.18),transparent_68%)]">
        </div>
        {{ $slot }}
    </div>

    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
