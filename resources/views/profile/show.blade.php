<x-layouts.app title="{{ $user->name }}'s Profile - {{ config('app.name') }}" sidebar="global">
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Profile Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-2xl overflow-hidden shadow-xl mb-8">
            <div class="p-8">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                    <!-- Avatar Section -->
                    <div class="flex-shrink-0">
                        @if($user->avatar_path)
                            <img src="{{ asset('storage/' . $user->avatar_path) }}"
                                 alt="{{ $user->name }}"
                                 class="w-40 h-40 rounded-3xl object-cover border-4 border-slate-800 shadow-2xl">
                        @else
                            <div class="w-40 h-40 rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center border-4 border-slate-800 shadow-2xl">
                                <span class="text-6xl font-black text-white/30 uppercase">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- User Info Section -->
                    <div class="flex-grow text-center md:text-left">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                            <div>
                                <h1 class="text-4xl font-black text-white tracking-tight">{{ $user->name }}</h1>
                                <p class="text-blue-400 font-medium">{{ $user->email }}</p>
                            </div>

                            @if(auth()->id() === $user->id)
                                <x-blue-button href="{{ route('profile.edit') }}" class="w-full md:w-auto">
                                    Edit Profile
                                </x-blue-button>
                            @endif
                        </div>

                        <!-- Bio -->
                        <div class="mb-8">
                            <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">About</h2>
                            <p class="text-slate-300 leading-relaxed text-lg">
                                {{ $user->bio ?: 'This user hasn\'t shared a bio yet.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <div class="px-5 py-3 bg-slate-800/50 rounded-2xl border border-slate-700/50 backdrop-blur-sm">
                                <span class="block text-[10px] text-slate-500 uppercase font-black tracking-tighter mb-1">Member Since</span>
                                <span class="font-bold text-slate-200">{{ $user->created_at->format('F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div>
            <h2 class="text-2xl font-black text-white mb-6 flex items-center gap-3">
                Public Teams
                <span class="px-2 py-0.5 bg-slate-800 rounded-lg text-sm text-slate-400">{{ $user->teams->count() }}</span>
            </h2>

            @if($user->teams->isEmpty())
                <div class="bg-slate-900/30 border border-slate-800 border-dashed rounded-2xl p-12 text-center">
                    <p class="text-slate-500 font-medium text-lg">No public teams found for this user.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($user->teams as $team)
                        <a href="{{ route('teams.show', $team) }}" class="flex items-center gap-5 p-5 rounded-2xl bg-slate-900/50 border border-slate-700 hover:border-blue-500/50 hover:bg-slate-800/50 transition-all group">
                            <div class="w-14 h-14 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 font-black text-2xl border border-blue-500/20 group-hover:scale-110 transition-transform shadow-inner">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-bold text-white text-lg truncate group-hover:text-blue-400 transition-colors">{{ $team->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $team->description ?: 'No description provided.' }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
