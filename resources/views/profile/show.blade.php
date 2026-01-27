<x-layouts.app title="{{ $user->name }}'s Profile - {{ config('app.name') }}" sidebar="global">
    <div class="max-w-5xl mx-auto">
        <!-- Profile Card -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] overflow-hidden shadow-2xl mb-12 relative">
            <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-r from-blue-900/20 to-purple-900/20"></div>
            
            <div class="p-10 relative z-10 pt-16">
                <div class="flex flex-col md:flex-row items-start gap-10">
                    <!-- Avatar Section -->
                    <div class="flex-shrink-0 -mt-6">
                        @if($user->avatar_path)
                            <img src="{{ asset('storage/' . $user->avatar_path) }}"
                                 alt="{{ $user->name }}"
                                 class="w-40 h-40 rounded-[2rem] object-cover border-4 border-slate-900 shadow-2xl">
                        @else
                            <div class="w-40 h-40 rounded-[2rem] bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center border-4 border-slate-900 shadow-2xl">
                                <span class="text-6xl font-black text-white/40 uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- User Info Section -->
                    <div class="flex-grow w-full">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8">
                            <div>
                                <h1 class="text-4xl font-extrabold text-white tracking-tight mb-1">{{ $user->name }}</h1>
                                <p class="text-blue-400 font-medium text-lg">{{ $user->email }}</p>
                            </div>

                            @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-full transition-all shadow-lg hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    Edit Profile
                                </a>
                            @endif
                        </div>

                        <!-- Bio -->
                        <div class="mb-8 max-w-2xl">
                            <h2 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">About</h2>
                            <p class="text-slate-300 leading-relaxed text-lg font-medium">
                                {{ $user->bio ?: 'This user hasn\'t shared a bio yet.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <div class="px-6 py-3 bg-slate-950/50 rounded-2xl border border-slate-800/50 backdrop-blur-sm flex items-center gap-3">
                                <div class="p-1.5 bg-slate-800 rounded-lg text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                </div>
                                <div>
                                    <span class="block text-[10px] text-slate-500 uppercase font-black tracking-widest leading-none mb-1">Joined</span>
                                    <span class="font-bold text-white text-sm">{{ $user->created_at->format('F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div>
            <div class="flex items-center gap-4 mb-8">
                <div class="w-1.5 h-8 bg-blue-500 rounded-full"></div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Public Workspaces</h2>
                <span class="px-3 py-1 bg-slate-900 border border-slate-800 rounded-full text-xs font-bold text-slate-400">{{ $user->teams->count() }}</span>
            </div>

            @if($user->teams->isEmpty())
                <div class="bg-slate-900/20 border border-slate-800 border-dashed rounded-[2.5rem] p-16 text-center">
                    <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <p class="text-slate-500 font-bold text-lg">No public workspaces found.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->teams as $team)
                        <a href="{{ route('teams.show', $team) }}" class="group relative block p-6 rounded-[2rem] bg-slate-900/50 border border-slate-800 hover:bg-slate-900 hover:border-blue-500/30 transition-all duration-300 shadow-lg">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-center text-blue-500 font-black text-xl shadow-inner group-hover:scale-110 transition-transform">
                                    {{ substr($team->name, 0, 1) }}
                                </div>
                                <div class="p-2 bg-slate-950 rounded-xl text-slate-600 group-hover:text-blue-400 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-white text-lg truncate group-hover:text-blue-400 transition-colors mb-2">{{ $team->name }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed">{{ $team->description ?: 'No description provided.' }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>