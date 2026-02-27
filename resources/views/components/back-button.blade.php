@props(['href' => '/'])

<div class="flex">
    <a href="{{ $href }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150 group">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1">
            <path d="m15 18-6-6 6-6"></path>
        </svg>
        {{ $slot->isEmpty() ? 'Go back' : $slot }}
    </a>
</div>
