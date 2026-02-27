<x-layouts.app title="My Teams - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h2 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">My Workspaces</h2>
                <p class="text-text-secondary text-sm">Manage your existing teams or bootstrap a new one.</p>
            </div>
            <x-blue-button href="{{ route('teams.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Create Team
            </x-blue-button>
        </div>

        <div class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            @if($teams->isEmpty())
                <div class="bg-surface-1 border border-border border-dashed rounded-[8px] p-12 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 mb-6 border border-border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-text-primary mb-2">Zero workspaces found</h3>
                    <p class="text-text-secondary max-w-md mx-auto mb-8 text-[13px] leading-relaxed">It looks like you're not part of any teams yet. Create your first workspace to start collaborating.</p>
                    <x-blue-button href="{{ route('teams.create') }}">
                        Build My First Team
                    </x-blue-button>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($teams as $team)
                        <a href="{{ route('teams.show', $team->slug) }}" class="group relative block bg-surface-1 border border-border rounded-[8px] p-6 hover:border-border-light hover:bg-surface-2 hover:-translate-y-[1px] transition-all duration-150 flex flex-col h-full">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-12 h-12 rounded-[6px] bg-surface-3 flex items-center justify-center text-text-primary font-mono text-lg border border-border overflow-hidden">
                                    @if($team->logo)
                                        <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($team->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    @if($team->pivot->is_admin)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono bg-accent/15 text-accent border border-accent/20 uppercase tracking-[0.08em]">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-[4px] text-[10px] font-mono bg-surface-2 text-text-secondary border border-border uppercase tracking-[0.08em]">
                                            Member
                                        </span>
                                    @endif

                                    @if($team->is_private)
                                        <div class="flex items-center gap-1.5 text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            Private
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-lg font-medium text-text-primary mb-2 group-hover:text-accent transition-colors duration-150 truncate">{{ $team->name }}</h3>
                            <p class="text-text-secondary text-[13px] leading-relaxed mb-6 flex-grow line-clamp-2">{{ Str::limit($team->description, 120) }}</p>

                            <div class="flex items-center gap-4 pt-4 border-t border-border">
                                <div class="flex items-center gap-1.5 text-text-muted font-mono text-[11px] uppercase tracking-[0.08em]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                                    <span>{{ $team->tickets_count ?? 0 }} Tickets</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-text-muted font-mono text-[11px] uppercase tracking-[0.08em]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    <span>{{ $team->users_count ?? 0 }} Members</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
