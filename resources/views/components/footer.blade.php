<footer {{ $attributes->merge(['class' => 'bg-slate-900 border-t border-slate-800 py-12']) }}>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-white">
                T
            </div>
            <span class="text-lg font-bold text-white tracking-tight">Ticket Hub</span>
        </div>
        
        <p class="text-sm text-slate-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </p>
        
        <div class="flex gap-6">
            <a href="#" class="text-slate-500 hover:text-white transition-colors">Privacy</a>
            <a href="#" class="text-slate-500 hover:text-white transition-colors">Terms</a>
            <a href="#" class="text-slate-500 hover:text-white transition-colors">Contact</a>
        </div>
    </div>
</footer>
