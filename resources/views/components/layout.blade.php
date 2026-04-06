<!DOCTYPE html>
<html lang="pl" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Fizjoterapia</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-full bg-slate-50 text-slate-900 antialiased">
    @include('partials.navigation')

    <div class="relative isolate">
        <div
            class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-80 bg-[radial-gradient(ellipse_at_top,rgba(52,152,219,0.12),transparent_60%)]">
        </div>
        {{ $slot }}
    </div>

    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
