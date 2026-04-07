@props([
    'label' => null,
    'name',
    'rows' => 4,
])

<label class="block">
    @if ($label)
        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.14em] text-slate-500 dark:text-slate-400">{{ $label }}</span>
    @endif

    <textarea name="{{ $name }}" rows="{{ $rows }}" {{ $attributes->except(['class'])->merge(['class' => 'w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand-500 focus:ring-4 focus:ring-brand-300/20 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 dark:focus:border-brand-300 dark:focus:ring-brand-400/20']) }}>{{ $slot }}</textarea>

    @error($name)
        <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
    @enderror
</label>
