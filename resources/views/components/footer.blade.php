<footer {{ $attributes->merge(['class' => 'bg-bg border-t border-border py-12']) }}>
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-[6px] bg-accent flex items-center justify-center font-display font-medium text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
            </div>
            <span class="text-base font-display font-medium text-text-primary tracking-tight">Ticket Hub</span>
        </div>
        
        <p class="text-[13px] text-text-muted font-mono uppercase tracking-[0.08em]">
            &copy; {{ date('Y') }} MIT License.
        </p>
        
        <div class="flex gap-6">
            <a href="#" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-text-primary transition-colors duration-150">Privacy</a>
            <a href="#" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-text-primary transition-colors duration-150">Terms</a>
            <a href="#" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted hover:text-text-primary transition-colors duration-150">Contact</a>
        </div>
    </div>
</footer>
