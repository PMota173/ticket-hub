@props(['href' => '/'])

<div class="flex">
    <a href="{{ $href }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-white transition-colors duration-200 group">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left w-4 h-4 transition-transform group-hover:-translate-x-1">
            <path d="m15 18-6-6 6-6"></path>
        </svg>
        {{ $slot->isEmpty() ? 'Go back' : $slot }}
    </a>
</div>
