@props(['href' => null])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-semibold text-slate-200 transition-all duration-200 bg-transparent border border-slate-600 rounded-lg hover:bg-slate-700/50 hover:text-white hover:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $baseClasses, 'type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif
