<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Blad serwera</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <main class="mx-auto flex min-h-screen max-w-3xl items-center px-6 py-16">
        <div
            class="w-full rounded-2xl border border-slate-200 bg-white p-8 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-rose-600">Blad 500</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight">Wystapil nieoczekiwany problem</h1>
            <p class="mt-4 text-slate-600 dark:text-slate-300">Pracujemy nad rozwiazaniem. Sprobuj ponownie za chwile.
            </p>
            <div class="mt-6">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-slate-100 dark:text-slate-900 dark:hover:bg-white">
                    Wroc na start
                </a>
            </div>
        </div>
    </main>
</body>

</html>
