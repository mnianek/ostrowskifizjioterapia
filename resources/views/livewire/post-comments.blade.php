<section class="mt-10 rounded-2xl border border-slate-100 bg-white p-6 sm:p-8 dark:border-slate-800 dark:bg-slate-950">
    <h2 class="text-2xl font-bold tracking-[-0.015em] text-slate-900 dark:text-white">Komentarze</h2>

    @if (session('comment_status'))
        <div
            class="mt-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">
            {{ session('comment_status') }}
        </div>
    @endif

    @if ($interactionMessage)
        <div
            class="mt-4 rounded-xl border border-sky-200 bg-sky-50 px-4 py-3 text-sm text-sky-800 dark:border-sky-900/40 dark:bg-sky-950/40 dark:text-sky-300">
            {{ $interactionMessage }}
        </div>
    @endif

    <div class="mt-6 space-y-4">
        @forelse ($comments as $comment)
            <article
                class="rounded-xl border p-4 {{ $comment->is_pinned ? 'border-amber-300 bg-amber-50/60 dark:border-amber-700 dark:bg-amber-900/20' : ($comment->is_approved ? 'border-slate-200 bg-slate-50 dark:border-slate-800 dark:bg-slate-900' : 'border-amber-200 bg-amber-50/60 dark:border-amber-700 dark:bg-amber-900/20') }}">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <p class="font-semibold text-slate-900 dark:text-white">{{ $comment->user_name }}</p>
                        @if (!$comment->is_approved)
                            <span
                                class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-800 dark:border-amber-600 dark:bg-amber-900/50 dark:text-amber-200">
                                Oczekuje na zatwierdzenie
                            </span>
                        @endif
                        @if ($comment->is_pinned)
                            <span
                                class="inline-flex items-center gap-1 rounded-full border border-amber-300 bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-800 dark:border-amber-600 dark:bg-amber-900/50 dark:text-amber-200">
                                <span aria-hidden="true">📌</span>
                                Przypięty komentarz
                            </span>
                        @endif
                    </div>
                    <time class="text-xs text-slate-500 dark:text-slate-400"
                        datetime="{{ $comment->created_at->toDateString() }}">
                        {{ $comment->created_at->translatedFormat('d.m.Y H:i') }}
                    </time>
                </div>

                <p class="mt-3 whitespace-pre-line text-sm leading-relaxed text-slate-700 dark:text-slate-300">
                    {{ $comment->content }}
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <button type="button" wire:click="toggleLike({{ $comment->id }})"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-rose-300 hover:text-rose-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-rose-700 dark:hover:text-rose-400">
                        <span
                            class="{{ $this->userLikedComment($comment) ? 'text-rose-500' : 'text-slate-400 dark:text-slate-500' }}">♥</span>
                        <span>Lubię to ({{ $comment->likes_count + $comment->guest_likes_count }})</span>
                    </button>

                    <button type="button" wire:click="toggleReplyForm({{ $comment->id }})"
                        class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-sky-300 hover:text-sky-700 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-sky-700 dark:hover:text-sky-300">
                        Odpowiedz
                    </button>

                    <button type="button" wire:click="reportComment({{ $comment->id }})"
                        class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-amber-300 hover:text-amber-700 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-amber-700 dark:hover:text-amber-300">
                        Zgłoś
                    </button>

                    @if ($this->canPinComments())
                        <button type="button" wire:click="pinComment({{ $comment->id }})"
                            class="inline-flex items-center rounded-lg border border-amber-300 bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-800 transition hover:bg-amber-200 dark:border-amber-700 dark:bg-amber-900/40 dark:text-amber-200 dark:hover:bg-amber-900/60">
                            Przypnij
                        </button>
                    @endif
                </div>

                @if ($replyingTo === $comment->id)
                    <form wire:submit="addReply"
                        class="mt-4 rounded-xl border border-slate-200 bg-white p-4 dark:border-slate-800 dark:bg-slate-950">
                        <input type="text" wire:model="replyWebsite" tabindex="-1" autocomplete="off" class="hidden"
                            aria-hidden="true">

                        <div class="space-y-3">
                            <div>
                                <label for="replyUserName"
                                    class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Imię</label>
                                <input id="replyUserName" type="text" wire:model="replyUserName"
                                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25">
                                @error('replyUserName')
                                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="replyContent"
                                    class="block text-xs font-semibold text-slate-700 dark:text-slate-300">Treść
                                    odpowiedzi</label>
                                <textarea id="replyContent" rows="3" wire:model="replyContent"
                                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25"></textarea>
                                @error('replyContent')
                                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex gap-2">
                                <button type="submit"
                                    class="inline-flex items-center rounded-lg bg-[#3498db] px-4 py-2 text-xs font-semibold text-white transition hover:bg-[#2d83bd]">
                                    Wyślij odpowiedź
                                </button>
                                <button type="button" wire:click="toggleReplyForm({{ $comment->id }})"
                                    class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                                    Anuluj
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                @if ($comment->replies->isNotEmpty())
                    <div class="mt-4 space-y-3 border-l border-slate-200 pl-4 dark:border-slate-700 sm:ml-4">
                        @foreach ($comment->replies as $reply)
                            <article
                                class="rounded-lg border p-3 {{ $reply->is_approved ? 'border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-950' : 'border-amber-200 bg-amber-50/60 dark:border-amber-700 dark:bg-amber-900/20' }}">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                            {{ $reply->user_name }}</p>
                                        @if (!$reply->is_approved)
                                            <span
                                                class="inline-flex items-center rounded-full border border-amber-300 bg-amber-100 px-2 py-0.5 text-[11px] font-semibold text-amber-800 dark:border-amber-600 dark:bg-amber-900/50 dark:text-amber-200">
                                                Oczekuje na zatwierdzenie
                                            </span>
                                        @endif
                                    </div>
                                    <time class="text-xs text-slate-500 dark:text-slate-400"
                                        datetime="{{ $reply->created_at->toDateString() }}">
                                        {{ $reply->created_at->translatedFormat('d.m.Y H:i') }}
                                    </time>
                                </div>
                                <p
                                    class="mt-2 whitespace-pre-line text-sm leading-relaxed text-slate-700 dark:text-slate-300">
                                    {{ $reply->content }}
                                </p>
                                <div class="mt-3">
                                    <button type="button" wire:click="toggleLike({{ $reply->id }})"
                                        class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-rose-300 hover:text-rose-600 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-rose-700 dark:hover:text-rose-400">
                                        <span
                                            class="{{ $this->userLikedComment($reply) ? 'text-rose-500' : 'text-slate-400 dark:text-slate-500' }}">♥</span>
                                        <span>Lubię to ({{ $reply->likes_count + $reply->guest_likes_count }})</span>
                                    </button>

                                    <button type="button" wire:click="reportComment({{ $reply->id }})"
                                        class="ml-2 inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:border-amber-300 hover:text-amber-700 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:border-amber-700 dark:hover:text-amber-300">
                                        Zgłoś
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </article>
        @empty
            <p class="text-sm text-slate-600 dark:text-slate-300">Brak zatwierdzonych komentarzy. Bądź pierwszą osobą,
                która doda opinię.</p>
        @endforelse
    </div>

    <div class="mt-8 border-t border-slate-100 pt-6 dark:border-slate-800">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Dodaj komentarz</h3>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
            Zasady moderacji: nie publikujemy treści obraźliwych, reklamowych i niezgodnych z tematem. Użyj opcji
            „Zgłoś”, jeśli komentarz narusza zasady.
        </p>

        <form wire:submit="addComment" class="mt-4 space-y-4">
            <input type="text" wire:model="website" tabindex="-1" autocomplete="off" class="hidden"
                aria-hidden="true">

            <div>
                <label for="userName" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Imię</label>
                <input id="userName" type="text" wire:model="userName"
                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25"
                    required>
                @error('userName')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Treść</label>
                <textarea id="content" rows="4" wire:model="content"
                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-[#3498db] focus:outline-none focus:ring-2 focus:ring-[#3498db]/25 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/25"
                    required></textarea>
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
