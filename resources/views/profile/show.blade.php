<x-layouts.app title="{{ $user->name }}'s Profile - {{ config('app.name') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <!-- Profile Card -->
        <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden mb-12 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div class="p-8">
                <div class="flex flex-col md:flex-row items-start gap-8">
                    <!-- Avatar Section -->
                    <div class="flex-shrink-0">
                        @if($user->avatar_path)
                            <img src="{{ asset('storage/' . $user->avatar_path) }}"
                                 alt="{{ $user->name }}"
                                 class="w-24 h-24 rounded-[6px] object-cover border border-border">
                        @else
                            <div class="w-24 h-24 rounded-[6px] bg-surface-2 flex items-center justify-center border border-border">
                                <span class="text-4xl font-display font-medium text-text-secondary uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- User Info Section -->
                    <div class="flex-grow w-full">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-6">
                            <div>
                                <h1 class="text-3xl font-display font-medium text-text-primary tracking-tight mb-1">{{ $user->name }}</h1>
                                <p class="text-text-secondary font-mono text-[13px]">{{ $user->email }}</p>
                            </div>

                            @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2 bg-surface-2 hover:bg-surface-3 text-text-primary border border-border text-[11px] font-mono uppercase tracking-[0.08em] px-5 py-2.5 rounded-[6px] transition-all duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    Edit Profile
                                </a>
                            @endif
                        </div>

                        <!-- Bio -->
                        <div class="mb-6 max-w-2xl">
                            <h2 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-3">About</h2>
                            <p class="text-text-secondary leading-relaxed text-[14px]">
                                {{ $user->bio ?: 'This user hasn\'t shared a bio yet.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <div class="px-4 py-3 bg-surface-2 rounded-[6px] border border-border flex items-center gap-3">
                                <div class="p-1.5 bg-bg rounded-[4px] border border-border text-text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-text-muted uppercase font-mono tracking-[0.08em] leading-none mb-1">Joined</span>
                                    <span class="font-medium text-text-primary text-[13px]">{{ $user->created_at->format('F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2 h-2 bg-text-secondary"></div>
                <h2 class="text-[13px] font-mono text-text-primary uppercase tracking-[0.08em]">Public Workspaces</h2>
                <span class="px-2 py-0.5 bg-surface-2 border border-border rounded-[4px] text-[10px] font-mono text-text-secondary">{{ $user->teams->count() }}</span>
            </div>

            @if($user->teams->isEmpty())
                <div class="bg-surface-1 border border-border border-dashed rounded-[8px] p-12 text-center">
                    <div class="w-12 h-12 bg-surface-2 rounded-[6px] flex items-center justify-center mx-auto mb-4 text-text-secondary border border-border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <p class="text-text-secondary font-medium text-[13px]">No public workspaces found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->teams as $team)
                        <a href="{{ route('teams.show', $team) }}" class="group relative block p-5 rounded-[8px] bg-surface-1 border border-border hover:bg-surface-2 hover:border-border-light transition-all duration-150 hover:-translate-y-[1px]">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-10 h-10 rounded-[6px] bg-surface-3 border border-border flex items-center justify-center text-text-primary font-mono text-lg transition-transform">
                                    {{ substr($team->name, 0, 1) }}
                                </div>
                                <div class="p-1.5 text-text-muted group-hover:text-accent transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </div>
                            </div>
                            <h3 class="font-medium text-text-primary text-[15px] truncate group-hover:text-accent transition-colors duration-150 mb-2">{{ $team->name }}</h3>
                            <p class="text-[13px] text-text-secondary line-clamp-2 leading-relaxed">{{ $team->description ?: 'No description provided.' }}</p>
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
