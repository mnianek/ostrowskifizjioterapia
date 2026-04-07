<!DOCTYPE html>
<html lang="pl" class="h-full bg-slate-50 dark:bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Fizjoterapia</title>

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
    class="min-h-full bg-slate-50 text-slate-900 antialiased transition-colors duration-300 dark:bg-slate-900 dark:text-slate-100">
    @include('partials.navigation')

    <div class="relative isolate">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-[radial-gradient(ellipse_at_top,rgba(52,152,219,0.12),transparent_60%)] dark:bg-[radial-gradient(ellipse_at_top,rgba(14,165,233,0.16),transparent_60%)]">
        </div>
        {{ $slot }}
    </div>

    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
