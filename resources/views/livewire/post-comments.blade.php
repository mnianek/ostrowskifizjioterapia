<section class="surface-glass mt-10 p-6 sm:p-8">
    <h2 class="text-ink dark:text-paper">Komentarze</h2>

    @if (session('comment_status'))
        <div
            class="mt-4 rounded-2xl border border-sage-300/60 bg-sage-100/70 px-4 py-3 text-sm text-sage-800 dark:border-sage-600/35 dark:bg-sage-900/20 dark:text-sage-200">
            {{ session('comment_status') }}
        </div>
    @endif

    @if ($interactionMessage)
        <div
            class="mt-4 rounded-2xl border border-ink/15 bg-paper/80 px-4 py-3 text-sm text-ink/80 dark:border-paper/15 dark:bg-paper/10 dark:text-paper/80">
            {{ $interactionMessage }}
        </div>
    @endif

    <div class="mt-6 space-y-5">
        @forelse ($comments as $comment)
            <article
                class="rounded-3xl border p-5 sm:p-6 {{ $comment->is_pinned ? 'border-sage-400/50 bg-sage-100/45 dark:border-sage-500/40 dark:bg-sage-900/20' : ($comment->is_approved ? 'border-ink/10 bg-paper/75 dark:border-paper/10 dark:bg-paper/5' : 'border-sage-300/50 bg-sage-100/40 dark:border-sage-500/35 dark:bg-sage-900/20') }}">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <p class="text-xl font-semibold text-ink dark:text-paper">{{ $comment->user_name }}</p>
                        @if (!$comment->is_approved)
                            <span
                                class="inline-flex items-center gap-1 rounded-full border border-sage-300/70 bg-sage-100 px-2.5 py-1 text-[11px] font-semibold text-sage-800 dark:border-sage-500/40 dark:bg-sage-900/30 dark:text-sage-200">
                                Oczekuje na zatwierdzenie
                            </span>
                        @endif
                        @if ($comment->is_pinned)
                            <span
                                class="inline-flex items-center gap-1 rounded-full border border-sage-300/70 bg-sage-100 px-2.5 py-1 text-[11px] font-semibold text-sage-800 dark:border-sage-500/40 dark:bg-sage-900/30 dark:text-sage-200">
                                <span aria-hidden="true">PIN</span>
                                Przypięty komentarz
                            </span>
                        @endif
                    </div>
                    <time class="text-sm text-ink/55 dark:text-paper/55"
                        datetime="{{ $comment->created_at->toDateString() }}">
                        {{ $comment->created_at->translatedFormat('d.m.Y H:i') }}
                    </time>
                </div>

                <p class="mt-4 whitespace-pre-line text-lg leading-8 text-ink/82 dark:text-paper/82">
                    {{ $comment->content }}
                </p>

                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <button type="button" wire:click="toggleLike({{ $comment->id }})"
                        aria-label="Polub komentarz {{ $comment->user_name }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-ink/15 bg-paper px-4 py-2 text-sm font-semibold text-ink/80 transition hover:border-sage/55 hover:text-sage-700 dark:border-paper/15 dark:bg-paper/5 dark:text-paper/80 dark:hover:border-sage/55 dark:hover:text-sage-200">
                        <span
                            class="{{ $this->userLikedComment($comment) ? 'text-sage-600 dark:text-sage-200' : 'text-ink/35 dark:text-paper/45' }}">♥</span>
                        <span>Lubię to ({{ $comment->likes_count + $comment->guest_likes_count }})</span>
                    </button>

                    <button type="button" wire:click="toggleReplyForm({{ $comment->id }})"
                        aria-label="Odpowiedz na komentarz {{ $comment->user_name }}"
                        class="inline-flex items-center rounded-xl border border-ink/15 bg-paper px-4 py-2 text-sm font-semibold text-ink/80 transition hover:border-sage/55 hover:text-sage-700 dark:border-paper/15 dark:bg-paper/5 dark:text-paper/80 dark:hover:border-sage/55 dark:hover:text-sage-200">
                        Odpowiedz
                    </button>

                    <button type="button" wire:click="reportComment({{ $comment->id }})"
                        aria-label="Zglos komentarz {{ $comment->user_name }}"
                        class="inline-flex items-center rounded-xl border border-ink/15 bg-paper px-4 py-2 text-sm font-semibold text-ink/80 transition hover:border-sage/55 hover:text-sage-700 dark:border-paper/15 dark:bg-paper/5 dark:text-paper/80 dark:hover:border-sage/55 dark:hover:text-sage-200">
                        Zgłoś
                    </button>

                    @if ($this->canPinComments())
                        <button type="button" wire:click="pinComment({{ $comment->id }})"
                            aria-label="Przypnij komentarz {{ $comment->user_name }}"
                            class="inline-flex items-center rounded-xl border border-sage-400/60 bg-sage-100 px-4 py-2 text-sm font-semibold text-sage-800 transition hover:bg-sage-200/80 dark:border-sage-500/40 dark:bg-sage-900/35 dark:text-sage-200 dark:hover:bg-sage-900/50">
                            Przypnij
                        </button>
                    @endif
                </div>

                @if ($replyingTo === $comment->id)
                    <form wire:submit="addReply"
                        class="mt-5 rounded-2xl border border-ink/10 bg-paper/70 p-4 dark:border-paper/10 dark:bg-paper/5">
                        <input type="text" wire:model="replyWebsite" tabindex="-1" autocomplete="off" class="hidden"
                            aria-hidden="true">

                        <div class="space-y-4">
                            <div>
                                <x-ui.input id="replyUserName" name="replyUserName" label="Imię"
                                    wire:model="replyUserName" />
                            </div>

                            <div>
                                <x-ui.textarea id="replyContent" name="replyContent" label="Treść odpowiedzi"
                                    rows="3" wire:model="replyContent" />
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" class="btn-primary px-4 py-2 text-xs">
                                    Wyślij odpowiedź
                                </button>
                                <button type="button" wire:click="toggleReplyForm({{ $comment->id }})"
                                    class="btn-secondary px-4 py-2 text-xs">
                                    Anuluj
                                </button>
                            </div>
                        </div>
                    </form>
                @endif

                @if ($comment->replies->isNotEmpty())
                    <div class="mt-5 space-y-3 border-l border-ink/10 pl-4 dark:border-paper/10 sm:ml-4 sm:pl-6">
                        @foreach ($comment->replies as $reply)
                            <article
                                class="rounded-2xl border p-4 {{ $reply->is_approved ? 'border-ink/10 bg-paper/80 dark:border-paper/10 dark:bg-paper/5' : 'border-sage-300/50 bg-sage-100/40 dark:border-sage-500/35 dark:bg-sage-900/20' }}">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-2">
                                        <p class="text-base font-semibold text-ink dark:text-paper">
                                            {{ $reply->user_name }}</p>
                                        @if (!$reply->is_approved)
                                            <span
                                                class="inline-flex items-center rounded-full border border-sage-300/70 bg-sage-100 px-2 py-0.5 text-[11px] font-semibold text-sage-800 dark:border-sage-500/40 dark:bg-sage-900/30 dark:text-sage-200">
                                                Oczekuje na zatwierdzenie
                                            </span>
                                        @endif
                                    </div>
                                    <time class="text-xs text-ink/55 dark:text-paper/55"
                                        datetime="{{ $reply->created_at->toDateString() }}">
                                        {{ $reply->created_at->translatedFormat('d.m.Y H:i') }}
                                    </time>
                                </div>
                                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-ink/80 dark:text-paper/80">
                                    {{ $reply->content }}
                                </p>
                                <div class="mt-4 flex flex-wrap items-center gap-2">
                                    <button type="button" wire:click="toggleLike({{ $reply->id }})"
                                        aria-label="Polub odpowiedz {{ $reply->user_name }}"
                                        class="inline-flex items-center gap-2 rounded-xl border border-ink/15 bg-paper px-3 py-1.5 text-xs font-semibold text-ink/80 transition hover:border-sage/55 hover:text-sage-700 dark:border-paper/15 dark:bg-paper/5 dark:text-paper/80 dark:hover:border-sage/55 dark:hover:text-sage-200">
                                        <span
                                            class="{{ $this->userLikedComment($reply) ? 'text-sage-600 dark:text-sage-200' : 'text-ink/35 dark:text-paper/45' }}">♥</span>
                                        <span>Lubię to ({{ $reply->likes_count + $reply->guest_likes_count }})</span>
                                    </button>

                                    <button type="button" wire:click="reportComment({{ $reply->id }})"
                                        aria-label="Zglos odpowiedz {{ $reply->user_name }}"
                                        class="inline-flex items-center rounded-xl border border-ink/15 bg-paper px-3 py-1.5 text-xs font-semibold text-ink/80 transition hover:border-sage/55 hover:text-sage-700 dark:border-paper/15 dark:bg-paper/5 dark:text-paper/80 dark:hover:border-sage/55 dark:hover:text-sage-200">
                                        Zgłoś
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </article>
        @empty
            <p class="text-sm leading-7 text-ink/70 dark:text-paper/70">Brak zatwierdzonych komentarzy. Bądź pierwszą
                osobą,
                która doda opinię.</p>
        @endforelse
    </div>

    <div class="mt-10 border-t border-ink/10 pt-8 dark:border-paper/10">
        <h3 class="text-ink dark:text-paper">Dodaj komentarz</h3>
        <p class="mt-2 text-sm leading-7 text-ink/70 dark:text-paper/70">
            Zasady moderacji: nie publikujemy treści obraźliwych, reklamowych i niezgodnych z tematem. Użyj opcji
            „Zgłoś”, jeśli komentarz narusza zasady.
        </p>

        <form wire:submit="addComment"
            class="mt-6 space-y-4 rounded-2xl border border-ink/10 bg-paper/70 p-5 dark:border-paper/10 dark:bg-paper/5 sm:p-6">
            <input type="text" wire:model="website" tabindex="-1" autocomplete="off" class="hidden"
                aria-hidden="true">

            <div>
                <x-ui.input id="userName" name="userName" label="Imię" wire:model="userName" required />
            </div>

            <div>
                <x-ui.textarea id="content" name="content" label="Treść" rows="4" wire:model="content"
                    required />
            </div>

            <button type="submit" class="btn-primary px-5 py-2.5">
                Wyślij komentarz
            </button>
        </form>
    </div>
</section>
