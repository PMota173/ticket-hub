<div {{ $attributes->merge(['class' => 'p-6 transition-all duration-150 bg-surface-1 border border-border rounded-[8px] hover:border-border-light hover:bg-surface-2 group']) }}>
    <div class="flex flex-col h-full space-y-4 [&_h3]:text-lg [&_h3]:font-medium [&_h3]:font-display [&_h3]:text-text-primary group-hover:[&_h3]:text-accent [&_p]:text-text-secondary [&_p]:text-[13px] [&_p]:leading-relaxed">
        {{ $slot }}
    </div>
</div>
