@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'required' => false])

<div class="space-y-2">
    <label for="{{ $name }}" class="text-sm font-medium text-slate-300">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500']) }}
        placeholder="{{ $placeholder }}"
    >
</div>
