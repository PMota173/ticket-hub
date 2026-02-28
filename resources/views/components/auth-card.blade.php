<div {{ $attributes->merge(['class' => 'bg-surface-1 border border-border rounded-none p-8 relative']) }}>
    <!-- Decorative corners for the "Triage Terminal" feel -->
    <div class="absolute top-0 left-0 w-2 h-2 border-t border-l border-text-muted"></div>
    <div class="absolute top-0 right-0 w-2 h-2 border-t border-r border-text-muted"></div>
    <div class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-text-muted"></div>
    <div class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-text-muted"></div>
    {{ $slot }}
</div>