<x-layouts.app title="Invite Member - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Invite Member</h1>
                <p class="text-text-secondary text-[13px]">Grow your team by inviting new collaborators.</p>
            </div>
            <a href="{{ route('invitations.index', $team) }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                Cancel
            </a>
        </div>

        <div class="bg-surface-1 border border-border rounded-[8px] p-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <form action="{{ route('invitations.store', $team) }}" method="POST" class="space-y-8">
                @csrf

                <div class="space-y-6">
                    <div class="space-y-1.5">
                        <label for="email" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Recipient Email</label>
                        <input type="email" name="email" id="email" required autofocus placeholder="colleague@example.com"
                            class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-2.5 text-text-primary placeholder-text-muted focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] text-[13px] transition-all duration-150">
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 rounded-[6px] bg-accent/5 border border-accent/10 mt-4">
                        <div class="text-accent mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <p class="text-[13px] text-text-secondary leading-relaxed">
                            An invitation link will be sent to this email address. The user will be guided to create an account if they don't have one yet.
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-border mt-8 flex justify-end">
                    <x-blue-button type="submit">
                        Send Invitation
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
