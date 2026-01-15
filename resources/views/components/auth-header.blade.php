@props(['title', 'subtitle'])

<div class="flex flex-col items-center text-center space-y-2">
    <div class="bg-blue-600/10 p-3 rounded-xl ring-1 ring-blue-600/20 mb-2">
        {{ $slot }}
    </div>
    <h2 class="text-3xl font-bold tracking-tight text-white">{{ $title }}</h2>
    <p class="text-slate-400 leading-relaxed">{{ $subtitle }}</p>
</div>
