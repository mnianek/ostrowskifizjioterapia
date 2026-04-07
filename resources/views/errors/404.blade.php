<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Nie znaleziono strony</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <main class="mx-auto flex min-h-screen max-w-3xl items-center px-6 py-16">
        <div
            class="w-full rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-sky-600">Blad 404</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight">Nie znalezlismy tej strony</h1>
            <p class="mt-4 text-slate-600 dark:text-slate-300">Sprawdz adres URL albo wroc do strony glownej i przejdz
                dalej z menu.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center rounded-xl bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700">
                    Wroc na start
                </a>
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                    Zobacz blog
                </a>
            </div>
        </div>
    </main>
</body>

</html>
