<x-layouts.app title="My Teams - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">My Workspaces</h2>
                <p class="text-slate-400 text-lg">Manage your existing teams or bootstrap a new one.</p>
            </div>
            <x-blue-button href="{{ route('teams.create') }}" class="rounded-full px-6 py-3 shadow-lg shadow-blue-600/20 transition-transform hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Create Team
            </x-blue-button>
        </div>

        @if($teams->isEmpty())
            <div class="bg-slate-900/40 border border-slate-800 border-dashed rounded-3xl p-16 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-slate-800/50 mb-8 border border-slate-700 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-10 h-10 text-slate-500">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3 tracking-tight">Zero workspaces found</h3>
                <p class="text-slate-400 max-w-md mx-auto mb-10 text-lg leading-relaxed">It looks like you're not part of any teams yet. Create your first workspace to start collaborating.</p>
                <x-blue-button href="{{ route('teams.create') }}" class="rounded-full px-10 py-4 text-lg">
                    Build My First Team
                </x-blue-button>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($teams as $team)
                    <a href="{{ route('teams.show', $team->slug) }}" class="group relative block">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-indigo-600/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative bg-slate-900/50 border border-slate-800 rounded-3xl p-8 hover:border-blue-500/40 hover:bg-slate-900 transition-all duration-300 shadow-xl h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-black text-2xl shadow-lg group-hover:scale-110 transition-transform duration-300 overflow-hidden">
                                    @if($team->logo)
                                        <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($team->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    @if($team->pivot->is_admin)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-blue-500 text-white uppercase tracking-[0.1em] shadow-lg shadow-blue-500/20">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-slate-800 text-slate-400 border border-slate-700 uppercase tracking-[0.1em]">
                                            Member
                                        </span>
                                    @endif

                                    @if($team->is_private)
                                        <div class="flex items-center gap-1 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            Private
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-400 transition-colors tracking-tight">{{ $team->name }}</h3>
                            <p class="text-slate-400 text-base leading-relaxed mb-8 flex-grow opacity-80 group-hover:opacity-100 transition-opacity">{{ Str::limit($team->description, 120) }}</p>

                            <div class="flex items-center gap-6 pt-6 border-t border-slate-800/50">
                                <div class="flex items-center gap-2 text-slate-400 font-medium text-sm">
                                    <div class="p-1.5 bg-slate-800 rounded-lg group-hover:bg-blue-500/10 group-hover:text-blue-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                    </div>
                                    <span>{{ $team->tickets_count ?? 0 }} Tickets</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-400 font-medium text-sm">
                                    <div class="p-1.5 bg-slate-800 rounded-lg group-hover:bg-purple-500/10 group-hover:text-purple-400 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    </div>
                                    <span>{{ $team->users_count ?? 0 }} Members</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>