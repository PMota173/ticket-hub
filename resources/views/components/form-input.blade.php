@props(['name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'required' => false])

<div class="space-y-1.5 flex flex-col">
    @if($label)
        <label for="{{ $name }}" class="block text-[10px] font-mono tracking-widest uppercase text-text-muted">{{ $label }}</label>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $attributes->get('value')) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-surface-1 border border-border text-text-primary rounded-none px-3 py-2 text-sm font-mono focus:outline-none focus:border-accent focus:ring-0 transition-colors duration-150 placeholder:text-text-muted']) }}
        placeholder="{{ $placeholder }}"
    >
    @error($name)
        <p class="text-[10px] font-mono text-danger mt-1">{{ $message }}</p>
    @enderror
</div>
