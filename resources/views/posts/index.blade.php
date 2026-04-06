<x-layout>
    <main class="bg-slate-50 font-[Inter,Geist,ui-sans-serif,system-ui,sans-serif]">
        <section class="relative overflow-hidden border-b border-slate-100 bg-white">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_85%_10%,rgba(11,42,74,0.12),transparent_45%)]">
            </div>
            <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[#0B2A4A]/70">Ostrowski Fizjoterapia</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-bold tracking-[-0.02em] text-slate-900 sm:text-5xl lg:text-6xl">
                    Baza Wiedzy Fizjoterapeutycznej
                </h1>
                <p class="mt-6 max-w-3xl text-lg leading-relaxed text-slate-600">
                    Tworzymy praktyczne materiały o zdrowiu, ruchu i terapii, aby pomóc pacjentom wracać do sprawności
                    szybciej,
                    bezpieczniej i bardziej świadomie.
                </p>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
            <div class="mb-8 flex flex-wrap items-center gap-3">
                <span
                    class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.12em] text-slate-600">
                    Kategorie
                </span>
                <a href="{{ route('posts.index') }}"
                    class="rounded-full border px-4 py-2 text-sm font-medium transition {{ $selectedCategory ? 'border-slate-200 bg-white text-slate-700 hover:border-[#0B2A4A]/30 hover:text-[#0B2A4A]' : 'border-[#0B2A4A]/30 bg-[#0B2A4A]/6 text-[#0B2A4A]' }}">
                    Wszystkie
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->id]) }}"
                        class="rounded-full border px-4 py-2 text-sm font-medium transition {{ (int) $selectedCategory === (int) $category->id ? 'border-[#0B2A4A]/30 bg-[#0B2A4A]/6 text-[#0B2A4A]' : 'border-slate-200 bg-white text-slate-700 hover:border-[#0B2A4A]/30 hover:text-[#0B2A4A]' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="space-y-6">
                @forelse ($posts as $post)
                    <article
                        class="group overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm transition duration-300 hover:shadow-xl md:flex">
                        <a href="{{ route('posts.show', $post->slug) }}" class="block md:w-80 md:shrink-0">
                            <div class="relative h-56 overflow-hidden bg-slate-100 md:h-full">
                                @php
                                    $featuredImageUrl =
                                        $post->getFirstMediaUrl('featured_image') ?:
                                        ($post->image_path || $post->photo
                                            ? asset('storage/' . ltrim($post->image_path ?? $post->photo, '/'))
                                            : null);
                                @endphp

                                @if ($featuredImageUrl)
                                    <img src="{{ $featuredImageUrl }}" alt="{{ $post->title }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div
                                        class="flex h-full items-center justify-center bg-linear-to-br from-slate-100 to-slate-200 text-xs font-semibold uppercase tracking-[0.16em] text-[#0B2A4A]/70">
                                        Ostrowski Fizjoterapia
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="space-y-4 p-6 md:flex-1">
                            <span
                                class="inline-flex rounded-full border border-[#0B2A4A]/12 bg-[#0B2A4A]/6 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.14em] text-[#0B2A4A]">
                                {{ $post->is_published ? 'Artykuł' : 'Szkic' }}
                            </span>

                            <h2
                                class="text-2xl font-bold tracking-[-0.015em] text-slate-900 transition group-hover:text-[#0B2A4A]">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="hover:text-[#3498db]">{{ $post->title }}</a>
                            </h2>

                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#3498db]">
                                {{ $post->category?->name ?? 'Bez kategorii' }}
                            </p>

                            <time class="block text-sm font-medium text-[#3498db]"
                                datetime="{{ $post->created_at?->toDateString() ?? '' }}">
                                {{ $post->created_at?->translatedFormat('d F Y') ?? 'Brak daty publikacji' }}
                            </time>

                            <p class="line-clamp-3 text-sm leading-7 text-slate-600">
                                {{ $post->lead ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 165) }}
                            </p>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                        <p class="text-lg text-slate-600">Brak artykułów do wyświetlenia.</p>
                        <a href="{{ route('posts.create') }}"
                            class="mt-4 inline-block font-semibold text-[#0B2A4A] transition hover:text-[#153f6b]">
                            Dodaj pierwszy wpis
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($posts->hasPages())
                <div class="mt-10 border-t border-slate-100 pt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        </section>
    </main>
</x-layout>
