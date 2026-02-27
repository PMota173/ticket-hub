@props(['title', 'subtitle'])

<div class="flex flex-col items-center text-center space-y-2">
    <div class="bg-accent/10 p-3 rounded-[6px] border border-accent/20 mb-2">
        {{ $slot }}
    </div>
    <h2 class="text-2xl font-display font-medium tracking-tight text-text-primary">{{ $title }}</h2>
    <p class="text-text-secondary text-[13px] leading-relaxed">{{ $subtitle }}</p>
</div>
