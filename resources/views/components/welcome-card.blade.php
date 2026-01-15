<div {{ $attributes->merge(['class' => 'p-6 transition-all duration-200 bg-slate-900/50 border border-slate-700 rounded-xl hover:bg-slate-900 hover:border-slate-600 shadow-sm hover:shadow-md']) }}>
    <div class="flex flex-col h-full space-y-4 [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-white [&_p]:text-slate-400 [&_p]:leading-relaxed">
        {{ $slot }}
    </div>
</div>
