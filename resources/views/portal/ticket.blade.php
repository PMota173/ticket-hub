<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $ticket->title }} - {{ $team->name }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-950 text-white flex min-h-screen flex-col font-sans antialiased selection:bg-blue-500">
    <x-header />

    <main class="flex-1 max-w-6xl mx-auto w-full px-6 lg:px-8 py-16">
        <!-- Back Navigation -->
        <div class="mb-12 flex items-center justify-between">
            <a href="{{ route('portal.show', $team) }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-white transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to {{ $team->name }} Hub
            </a>
            
            <a href="{{ route('portal.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 hover:text-blue-400">
                Explore All
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Ticket Header -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <x-ticket-status-badge :status="$ticket->status" />
                        <span class="text-slate-800 tracking-tighter">•</span>
                        <span class="text-slate-600 font-black font-mono text-xs tracking-widest uppercase">REF-{{ $ticket->id }}</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tighter">{{ $ticket->title }}</h1>
                    
                    <div class="flex items-center gap-4 bg-slate-900/50 p-4 rounded-3xl border border-slate-800 w-fit pr-8 shadow-xl">
                        <div class="flex-shrink-0">
                            @if($ticket->author?->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                     alt="{{ $ticket->author->name }}" 
                                     class="w-12 h-12 rounded-2xl object-cover border-2 border-slate-800 shadow-lg">
                            @else
                                <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-400 font-black border-2 border-slate-800 shadow-lg">
                                    {{ substr($ticket->author?->name ?? 'Unknown', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-white font-black text-xs uppercase tracking-widest">{{ $ticket->author?->name ?? 'Community Member' }}</p>
                            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-0.5">Reported {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-slate-900/30 border border-slate-800 rounded-[2.5rem] p-8 lg:p-10 shadow-inner relative overflow-hidden">
                    <div class="prose prose-invert max-w-none prose-p:leading-relaxed prose-p:text-lg text-slate-300 font-medium">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>
                
                @if($ticket->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 py-6 border-y border-slate-900">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] bg-slate-950 text-slate-500 border border-slate-800">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Comments -->
                <div class="pt-12">
                    <h3 class="text-xs font-black text-white uppercase tracking-[0.3em] mb-12 flex items-center gap-4">
                        Communication Thread
                        <div class="h-px flex-1 bg-slate-900"></div>
                    </h3>

                    <div class="space-y-10 mb-16">
                        @forelse($ticket->comments as $comment)
                            <div class="flex gap-6 group animate-fade-in">
                                <div class="flex-shrink-0">
                                    @if($comment->author->avatar_path ?? false)
                                        <img src="{{ asset('storage/' . $comment->author->avatar_path) }}" 
                                             alt="{{ $comment->author->name }}" 
                                             class="w-12 h-12 rounded-2xl object-cover border-2 border-slate-800 shadow-xl group-hover:border-blue-500/30 transition-all duration-500">
                                    @else
                                        <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-slate-500 font-black border-2 border-slate-800 shadow-xl group-hover:border-blue-500/30 transition-all duration-500">
                                            {{ substr($comment->author->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex items-center justify-between mb-3 px-1">
                                        <div class="flex items-center gap-3">
                                            <span class="text-xs font-black text-white uppercase tracking-widest">{{ $comment->author->name }}</span>
                                            <span class="text-[10px] font-bold text-slate-700 uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="bg-slate-900/50 rounded-[2rem] p-6 text-slate-300 leading-relaxed border border-slate-800 shadow-lg group-hover:bg-slate-900 transition-colors font-medium">
                                        {!! nl2br(e($comment->body)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 bg-slate-900/20 rounded-[3rem] border border-slate-900 border-dashed">
                                <p class="text-slate-600 font-black uppercase tracking-widest text-[10px]">No replies recorded</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Post Comment -->
                    @auth
                        <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] p-8 lg:p-10 shadow-2xl relative">
                            <div class="absolute top-0 left-10 right-10 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-50"></div>
                            <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        <h4 class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Join the Conversation</h4>
                                    </div>
                                    
                                    <textarea 
                                        name="body" 
                                        rows="4" 
                                        placeholder="Add your input to this thread..." 
                                        class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl p-6 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 placeholder:text-slate-800 resize-none min-h-[150px] transition-all font-medium text-lg outline-none"
                                        required
                                    ></textarea>
                                    
                                    @error('body')
                                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                                    @enderror
                                    
                                    <div class="flex justify-end pt-4">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full transition-all shadow-xl shadow-blue-900/40 hover:scale-105 active:scale-95">
                                            Post Reply
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-slate-900/50 rounded-[3rem] p-12 text-center border border-slate-800 shadow-xl">
                            <h4 class="text-xl font-black text-white uppercase tracking-widest mb-4">Thread Gated</h4>
                            <p class="text-slate-500 font-medium mb-10 max-w-sm mx-auto">You must be authenticated within the Ticket Hub network to contribute to this discussion.</p>
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="inline-flex bg-white text-slate-950 text-[10px] font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full hover:bg-slate-200 transition-all shadow-xl">
                                Verify Identity
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Team Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-indigo-600/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-5 mb-6">
                            @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }}" class="w-14 h-14 rounded-2xl object-cover border border-slate-800 shadow-xl group-hover:scale-110 transition-transform">
                            @else
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-xl font-black text-white shadow-xl group-hover:scale-110 transition-transform">
                                    {{ substr($team->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h3 class="font-black text-white text-lg tracking-tight leading-none mb-1">{{ $team->name }}</h3>
                                <a href="{{ route('portal.show', $team) }}" class="text-[10px] font-black text-blue-500 hover:text-blue-400 uppercase tracking-widest transition-colors flex items-center gap-1">
                                    Browse Hub <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium mb-8">
                            {{ \Illuminate\Support\Str::limit($team->description, 120) }}
                        </p>
                        
                        @auth
                            <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-slate-800 hover:bg-slate-700 text-white text-[10px] font-black uppercase tracking-widest py-4 rounded-2xl transition-all shadow-lg">
                                Submit New Report
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-slate-900/50 border border-slate-800 rounded-3xl p-8 shadow-inner">
                    <h3 class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] mb-8">Report Metadata</h3>
                    <div class="space-y-6 text-xs">
                        <div class="flex justify-between items-center group">
                            <span class="text-slate-500 font-bold uppercase tracking-widest">Initialized</span>
                            <span class="text-white font-black">{{ $ticket->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center group">
                            <span class="text-slate-500 font-bold uppercase tracking-widest">Last Update</span>
                            <span class="text-white font-black">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between items-center group pt-6 border-t border-slate-800">
                            <span class="text-slate-500 font-bold uppercase tracking-widest">Priority</span>
                            <div class="flex items-center gap-2">
                                @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><path d="M8 7L12 3L16 7"/><path d="M12 3V21"/></svg>
                                @elseif($ticket->priority->value === 'medium')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-orange-400"><path d="M5 12h14"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><path d="M8 17L12 21L16 17"/><path d="M12 3V21"/></svg>
                                @endif
                                <span class="text-white font-black uppercase tracking-widest">{{ $ticket->priority->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal remains standardized -->
    @auth
    <dialog id="create-ticket-modal" class="hidden open:flex bg-transparent backdrop:bg-slate-950/90 p-0 w-full h-full fixed inset-0 z-50 items-center justify-center open:animate-fade-in">
        <div class="bg-slate-900 border border-slate-800 rounded-[3rem] shadow-2xl overflow-hidden w-full max-w-2xl max-h-[90vh] flex flex-col relative mx-4">
            <div class="px-10 py-6 border-b border-slate-800 flex items-center justify-between bg-slate-900/80">
                <h3 class="text-xs font-black text-white uppercase tracking-[0.3em]">Initiate Submission</h3>
                <form method="dialog">
                    <button class="text-slate-600 hover:text-white transition-colors p-2 rounded-full hover:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </form>
            </div>
            
            <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-10 space-y-10 overflow-y-auto">
                @csrf
                <div class="space-y-8">
                    <div class="space-y-2">
                        <label for="title" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Issue Overview</label>
                        <input type="text" name="title" id="title" required placeholder="What needs attention?" 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none font-bold text-lg">
                    </div>
                    <div class="space-y-2">
                        <label for="description" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Context & Details</label>
                        <textarea name="description" id="description" rows="5" required placeholder="Describe the problem in high detail..." 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white placeholder-slate-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none resize-none font-medium leading-relaxed"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="priority" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Priority Level</label>
                            <div class="relative">
                                <select name="priority" id="priority" class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-6 py-4 text-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none appearance-none font-bold text-xs uppercase tracking-widest cursor-pointer">
                                    <option value="low">Low Priority</option>
                                    <option value="medium" selected>Medium Priority</option>
                                    <option value="high">High Priority</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4 flex items-center justify-end gap-6 border-t border-slate-800/50">
                    <form method="dialog">
                        <button class="text-[10px] font-black uppercase tracking-widest text-slate-600 hover:text-white transition-colors">Discard</button>
                    </form>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-8 py-4 rounded-full transition-all shadow-xl shadow-blue-900/40 hover:scale-105 active:scale-95">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </dialog>
    @endauth

    <x-footer />
</body>
</html>