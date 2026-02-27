@props(['name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'required' => false])

<div class="space-y-1.5">
    @if($label)
        <label for="{{ $name }}" class="block text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $attributes->get('value')) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-3 py-2 text-[13px] focus:outline-none focus:border-accent focus:ring-0 focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted']) }}
        placeholder="{{ $placeholder }}"
    >
    @error($name)
        <p class="text-[11px] font-mono text-danger mt-1">{{ $message }}</p>
    @enderror
</div>
