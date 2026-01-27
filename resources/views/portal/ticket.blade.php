<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $ticket->title }} - {{ $team->name }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-slate-900 text-white flex min-h-screen flex-col font-sans antialiased">
    <x-header />

    <main class="flex-1 max-w-5xl mx-auto w-full px-6 lg:px-8 py-12">
        <!-- Back Navigation -->
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('portal.show', $team) }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-white transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to {{ $team->name }}
            </a>
            
            <a href="{{ route('portal.index') }}" class="text-sm font-medium text-blue-400 hover:text-blue-300">
                Explore Teams
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Ticket Header -->
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <x-ticket-status-badge :status="$ticket->status" />
                        <span class="text-slate-500">•</span>
                        <span class="text-slate-400 font-mono">#{{ $ticket->id }}</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">{{ $ticket->title }}</h1>
                    
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0">
                            @if($ticket->author?->avatar_path)
                                <img src="{{ asset('storage/' . $ticket->author->avatar_path) }}" 
                                     alt="{{ $ticket->author->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border border-slate-700">
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                    {{ substr($ticket->author?->name ?? 'Unknown', 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-white font-medium">{{ $ticket->author?->name ?? 'Unknown User' }}</p>
                            <p class="text-slate-500 text-sm">opened {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose prose-invert max-w-none prose-p:leading-relaxed prose-a:text-blue-400 text-slate-300">
                    {!! nl2br(e($ticket->description)) !!}
                </div>
                
                @if($ticket->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-slate-800">
                        @foreach($ticket->tags as $tag)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <!-- Comments -->
                <div class="pt-10 mt-10 border-t border-slate-800">
                    <h3 class="text-xl font-bold text-white mb-8">Conversation</h3>

                    <div class="space-y-8 mb-10">
                        @forelse($ticket->comments as $comment)
                            <div class="flex gap-4 group">
                                <div class="flex-shrink-0">
                                    @if($comment->author->avatar_path ?? false)
                                        <img src="{{ asset('storage/' . $comment->author->avatar_path) }}" 
                                             alt="{{ $comment->author->name }}" 
                                             class="w-10 h-10 rounded-full object-cover border border-slate-700">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                            {{ substr($comment->author->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-white">{{ $comment->author->name }}</span>
                                        <span class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="bg-slate-800/50 rounded-xl p-4 text-slate-300 leading-relaxed border border-slate-700/50">
                                        {!! nl2br(e($comment->body)) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-slate-500 italic">No comments yet.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Post Comment -->
                    @auth
                        <div class="flex gap-4">
                             <div class="flex-shrink-0 hidden sm:block">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                         alt="{{ auth()->user()->name }}" 
                                         class="w-10 h-10 rounded-full object-cover border border-slate-700">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border border-slate-700">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <form action="{{ route('tickets.comments.store', [$team, $ticket]) }}" method="POST">
                                    @csrf
                                    <div class="relative">
                                        <textarea 
                                            name="body" 
                                            rows="3" 
                                            placeholder="Write a reply..." 
                                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl p-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder:text-slate-600 resize-y min-h-[100px] transition-all"
                                            required
                                        ></textarea>
                                        @error('body')
                                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-3 flex justify-end">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-medium px-6 py-2.5 rounded-xl transition-colors shadow-lg shadow-blue-900/20">
                                            Post Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="bg-slate-800/50 rounded-xl p-6 text-center border border-slate-700/50">
                            <h4 class="text-white font-medium mb-2">Join the conversation</h4>
                            <p class="text-slate-400 text-sm mb-4">You must be logged in to post a comment.</p>
                            <a href="{{ route('login') }}?redirect={{ url()->current() }}" class="inline-flex bg-blue-600 hover:bg-blue-500 text-white font-medium px-6 py-2 rounded-lg transition-colors">
                                Sign In
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Team Card -->
                <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6">
                    <div class="flex items-center gap-4 mb-4">
                        @if($team->logo)
                            <img src="{{ $team->logo }}" alt="{{ $team->name }}" class="w-12 h-12 rounded-xl object-cover border border-slate-600">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-lg font-bold border border-slate-600">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-bold text-white">{{ $team->name }}</h3>
                            <a href="{{ route('portal.show', $team) }}" class="text-xs text-blue-400 hover:text-blue-300">View Team Portal</a>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed mb-4">
                        {{ \Illuminate\Support\Str::limit($team->description, 100) }}
                    </p>
                    
                    @auth
                        <button onclick="document.getElementById('create-ticket-modal').showModal()" class="w-full bg-slate-700 hover:bg-slate-600 text-white text-sm font-medium py-2 rounded-lg transition-colors">
                            Submit New Ticket
                        </button>
                    @endauth
                </div>

                <!-- Info Card -->
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-5">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Ticket Info</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Created</span>
                            <span class="text-slate-200">{{ $ticket->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Last Activity</span>
                            <span class="text-slate-200">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Priority</span>
                            <div class="flex items-center gap-1.5">
                                @if($ticket->priority->value === 'high' || $ticket->priority->value === 'urgent')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><path d="M8 7L12 3L16 7"/><path d="M12 3V21"/></svg>
                                @elseif($ticket->priority->value === 'medium')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-orange-400"><path d="M5 12h14"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-green-500"><path d="M8 17L12 21L16 17"/><path d="M12 3V21"/></svg>
                                @endif
                                <span class="text-slate-200 capitalize font-medium">{{ $ticket->priority->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Reusing the Create Ticket Modal -->
    @auth
    <dialog id="create-ticket-modal" class="hidden open:flex bg-transparent backdrop:bg-slate-900/80 p-0 w-full h-full fixed inset-0 z-50 items-center justify-center open:animate-fade-in">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden w-full max-w-2xl max-h-[90vh] flex flex-col relative mx-4">
            <div class="px-6 py-4 border-b border-slate-700 flex items-center justify-between bg-slate-750">
                <h3 class="text-lg font-bold text-white">Create New Ticket</h3>
                <form method="dialog">
                    <button class="text-slate-400 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </form>
            </div>
            
            <form action="{{ route('portal.tickets.store', $team) }}" method="POST" class="p-6 space-y-6 overflow-y-auto">
                @csrf
                
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-slate-300">Issue Title</label>
                        <input type="text" name="title" id="title" required placeholder="What's the issue?" 
                            class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none">
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-slate-300">Description</label>
                        <textarea name="description" id="description" rows="5" required placeholder="Please provide as much detail as possible..." 
                            class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="priority" class="block text-sm font-medium text-slate-300">Priority</label>
                            <select name="priority" id="priority" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none appearance-none">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <form method="dialog">
                        <button class="px-4 py-2 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700 hover:text-white transition-colors font-medium">Cancel</button>
                    </form>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 transition-colors font-medium shadow-lg shadow-blue-900/20">Submit Ticket</button>
                </div>
            </form>
        </div>
    </dialog>
    @endauth

    <x-footer class="mt-auto" />
</body>
</html>
