<x-layouts.app title="My Teams - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-white">My Teams</h2>
                <p class="text-slate-400 mt-2">Select a team to manage or create a new one.</p>
            </div>
            <x-blue-button href="{{ route('teams.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                New Team
            </x-blue-button>
        </div>

        @if($teams->isEmpty())
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-800 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-8 h-8 text-slate-400">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">You don't have any teams yet</h3>
                <p class="text-slate-400 max-w-md mx-auto mb-8">Create a team to start managing support tickets for your products or services.</p>
                <x-blue-button href="{{ route('teams.create') }}" class="px-8 py-3">
                    Create Your First Team
                </x-blue-button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($teams as $team)
                    <a href="{{ route('teams.show', $team->slug) }}" class="block group">
                        <div class="bg-slate-900/50 border border-slate-700 rounded-xl p-6 hover:border-blue-500/50 hover:bg-slate-900 transition-all duration-200 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center text-blue-500 font-bold text-xl border border-blue-500/20">
                                    {{ substr($team->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    @if($team->is_admin)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 uppercase tracking-wider">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-800 text-slate-400 border border-slate-700 uppercase tracking-wider">
                                            Member
                                        </span>
                                    @endif

                                    @if($team->is_private)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium text-slate-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            Private
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">{{ $team->name }}</h3>
                            <p class="text-slate-400 text-sm mb-6 flex-1">{{ Str::limit($team->description, 100) }}</p>

                            <div class="flex items-center text-sm text-slate-500 gap-4 pt-4 border-t border-slate-800">
                                <div class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                    <span>{{ $team->tickets_count ?? 0 }} Tickets</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    <span>{{ $team->members_count ?? 0 }} Members</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
