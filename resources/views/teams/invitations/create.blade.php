<x-layouts.app title="Invite Member - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Invite Member</h2>
                <p class="text-slate-400 text-lg">Grow your team by inviting new collaborators.</p>
            </div>
            <x-back-button href="{{ route('invitations.index', $team) }}">
                Cancel
            </x-back-button>
        </div>

        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden relative p-10">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <form action="{{ route('invitations.store', $team) }}" method="POST" class="space-y-10">
                @csrf

                <div class="space-y-4">
                    <label for="email" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Recipient Email</label>
                    <input type="email" name="email" id="email" required autofocus placeholder="colleague@example.com"
                        class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder-slate-700 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-lg">
                    
                    <div class="flex items-start gap-3 p-4 rounded-2xl bg-blue-500/5 border border-blue-500/10 mt-4">
                        <div class="p-1.5 bg-blue-500/10 rounded-lg text-blue-400 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <p class="text-xs text-blue-300 font-medium leading-relaxed">
                            An invitation link will be sent to this email address. The user will be guided to create an account if they don't have one yet.
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-800/50 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full transition-all shadow-xl shadow-blue-600/20 hover:scale-105 active:scale-95">
                        Send Invitation
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>