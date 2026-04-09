@props([
    'label' => null,
    'name',
    'rows' => 4,
])

<label class="block">
    @if ($label)
        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.14em] text-ink/55 dark:text-paper/55">{{ $label }}</span>
    @endif

    <textarea name="{{ $name }}" rows="{{ $rows }}" {{ $attributes->except(['class'])->merge(['class' => 'w-full rounded-2xl border border-ink/15 bg-paper px-4 py-3 text-sm text-ink outline-none transition placeholder:text-ink/40 focus:border-sage focus:ring-4 focus:ring-sage/20 dark:border-paper/15 dark:bg-paper/5 dark:text-paper dark:placeholder:text-paper/40 dark:focus:border-sage dark:focus:ring-sage/15']) }}>{{ $slot }}</textarea>

    @error($name)
        <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
    @enderror
</label>
