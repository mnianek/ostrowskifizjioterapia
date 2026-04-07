<x-layout>
    <main class="bg-slate-50 font-[Inter,Geist,ui-sans-serif,system-ui,sans-serif] dark:bg-slate-900">
        <section class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
            <a href="{{ route('posts.index') }}"
                class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-[#0B2A4A] shadow-sm transition hover:border-[#0B2A4A]/30 hover:text-[#153f6b] dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:hover:border-sky-400 dark:hover:text-sky-300">
                <span aria-hidden="true">←</span>
                Powrót do listy
            </a>

            <article
                class="mt-6 overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-950">
                <div class="h-80 w-full overflow-hidden bg-slate-100 sm:h-105">
                    @php
                        $featuredImageUrl =
                            $post->getFirstMediaUrl('featured_image') ?:
                            ($post->image_path || $post->photo
                                ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                                : null);
                    @endphp

                    @if ($featuredImageUrl)
                        <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}" class="h-full w-full object-cover">
                    @else
                        <div
                            class="flex h-full items-center justify-center bg-linear-to-br from-slate-100 to-slate-200 text-sm font-semibold uppercase tracking-[0.18em] text-[#0B2A4A]/65">
                            Ostrowski Fizjoterapia
                        </div>
                    @endif
                </div>

                <div class="mx-auto max-w-3xl px-6 py-10 sm:px-10 lg:px-0 lg:py-14">
                    <nav class="mb-6 flex flex-wrap items-center gap-2 text-sm text-gray-500 dark:text-slate-400"
                        aria-label="Breadcrumb">
                        <a href="{{ route('home') }}"
                            class="font-medium transition hover:text-[#3498db] dark:hover:text-sky-300">Strona
                            Główna</a>
                        <span aria-hidden="true" class="text-gray-400 dark:text-slate-600">/</span>
                        <a href="{{ route('posts.index') }}"
                            class="font-medium transition hover:text-[#3498db] dark:hover:text-sky-300">Blog</a>
                        <span aria-hidden="true" class="text-gray-400 dark:text-slate-600">/</span>
                        <span class="font-medium text-slate-600 dark:text-slate-300">{{ $post->title }}</span>
                    </nav>

                    <div
                        class="mb-8 flex flex-wrap items-center gap-3 border-b border-slate-100 pb-6 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400">
                        <span
                            class="rounded-full border border-[#0B2A4A]/15 bg-[#0B2A4A]/6 px-3 py-1 font-semibold uppercase tracking-[0.12em] text-[#0B2A4A] dark:border-sky-400/20 dark:bg-sky-400/10 dark:text-sky-300">
                            {{ $post->is_published ? 'Opublikowano' : 'Szkic' }}
                        </span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="font-medium text-slate-700 dark:text-slate-300">{{ $post->author }}</span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <time
                            datetime="{{ $post->published_at?->toDateString() ?? ($post->created_at?->toDateString() ?? '') }}">
                            {{ $post->published_at?->translatedFormat('d F Y') ?? ($post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji') }}
                        </time>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span class="font-medium text-[#3498db] dark:text-sky-300">⏱ {{ $post->reading_time }} min
                            czytania</span>
                    </div>

                    <header>
                        <h1 class="text-4xl font-bold tracking-[-0.02em] text-slate-900 sm:text-5xl dark:text-white">
                            {{ $post->title }}
                        </h1>
                        @if ($post->lead)
                            <p class="mt-6 text-xl leading-relaxed text-slate-600 dark:text-slate-300">
                                {{ $post->lead }}
                            </p>
                        @endif
                    </header>

                    <div
                        class="prose prose-lg mt-10 max-w-none leading-8 text-slate-700 prose-headings:tracking-[-0.015em] prose-headings:text-[#0B2A4A] prose-strong:text-slate-900 prose-a:text-[#0B2A4A] prose-a:no-underline hover:prose-a:text-[#153f6b] prose-li:marker:text-[#0B2A4A]/70 dark:prose-invert dark:text-slate-300 dark:prose-headings:text-white dark:prose-strong:text-white dark:prose-a:text-sky-300 dark:hover:prose-a:text-sky-200 dark:prose-li:marker:text-sky-300/70">
                        {!! $post->content !!}
                    </div>

                    <section
                        class="mt-12 rounded-2xl border border-slate-100 bg-slate-50 p-6 sm:p-8 dark:border-slate-800 dark:bg-slate-900">
                        <h2 class="text-2xl font-bold tracking-[-0.015em] text-slate-900 dark:text-white">Umów się na
                            wizytę</h2>
                        <p class="mt-3 max-w-2xl text-base leading-relaxed text-slate-600 dark:text-slate-300">
                            Potrzebujesz indywidualnej diagnostyki i planu terapii? Skontaktuj się z gabinetem Ostrowski
                            Fizjoterapia i umów dogodny termin konsultacji.
                        </p>
                        <div class="mt-6">
                            <a href="#"
                                class="inline-flex items-center rounded-xl bg-[#0B2A4A] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#153f6b] hover:shadow-lg">
                                Umów wizytę
                            </a>
                        </div>
                    </section>

                    <section
                        class="mt-10 rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 dark:border-slate-800 dark:bg-slate-950">
                        <h2 class="text-2xl font-bold tracking-[-0.015em] text-slate-900 dark:text-white">Komentarze
                        </h2>

                        @if (session('comment_status'))
                            <div
                                class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">
                                {{ session('comment_status') }}
                            </div>
                        @endif

                        <div class="mt-6 space-y-4">
                            @forelse ($post->comments as $comment)
                                <article
                                    class="rounded-xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-900">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-semibold text-slate-900 dark:text-white">
                                            {{ $comment->user_name }}</p>
                                        <time class="text-xs text-slate-500 dark:text-slate-400"
                                            datetime="{{ $comment->created_at->toDateString() }}">
                                            {{ $comment->created_at->translatedFormat('d.m.Y H:i') }}
                                        </time>
                                    </div>
                                    <p
                                        class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-700 dark:text-slate-300">
                                        {{ $comment->content }}</p>
                                </article>
                            @empty
                                <p class="text-sm text-slate-600 dark:text-slate-300">Brak zatwierdzonych komentarzy.
                                    Bądź pierwszą osobą,
                                    która doda opinię.</p>
                            @endforelse
                        </div>

                        <div class="mt-8 border-t border-slate-100 pt-6 dark:border-slate-800">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Dodaj komentarz</h3>

                            <form class="mt-4 space-y-4" method="POST"
                                action="{{ route('posts.comments.store', $post->slug) }}">
                                @csrf

                                <div>
                                    <label for="user_name"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Imię</label>
                                    <input id="user_name" name="user_name" type="text"
                                        value="{{ old('user_name') }}"
                                        class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25"
                                        required>
                                    @error('user_name')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="content"
                                        class="block text-sm font-medium text-slate-700 dark:text-slate-300">Treść</label>
                                    <textarea id="content" name="content" rows="4"
                                        class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25"
                                        required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-[#3498db] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#2d83bd]">
                                    Wyślij komentarz
                                </button>
                            </form>
                        </div>
                    </section>
                </div>
            </article>
        </section>
    </main>
</x-layout>
