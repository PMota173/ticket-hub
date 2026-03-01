<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $article->title }} - {{ $team->name }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500|inter:400,500|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>
<body class="bg-bg text-text-primary flex min-h-screen flex-col font-sans antialiased selection:bg-accent selection:text-white relative">
    <x-header />

    <main class="flex-1 max-w-4xl mx-auto w-full px-6 lg:px-8 py-20">
        <!-- Back Navigation -->
        <div class="mb-10 flex items-center justify-between opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <a href="{{ route('portal.show', $team) }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1"><path d="m15 18-6-6 6-6"/></svg>
                Workspace
            </a>
            
            <a href="{{ route('portal.index') }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-accent hover:text-accent-hover transition-colors duration-150">
                Directory
            </a>
        </div>
        
        <div class="space-y-10 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <!-- Article Header -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-none text-[10px] font-mono uppercase tracking-[0.08em] bg-surface-2 text-text-secondary border border-border">Knowledge Base</span>
                    <span class="text-border-light font-mono text-[11px] uppercase tracking-[0.08em]">Written {{ $article->created_at->format('M d, Y') }}</span>
                </div>
                
                <h1 class="text-4xl font-display font-medium text-text-primary mb-8 leading-tight tracking-tight">{{ $article->title }}</h1>
                
                <div class="flex items-center gap-3 pb-8 border-b border-border">
                    <div class="flex-shrink-0">
                        @if($article->author?->avatar_path)
                            <img src="{{ asset('storage/' . $article->author->avatar_path) }}" 
                                 alt="{{ $article->author->name }}" 
                                 class="w-10 h-10 rounded-none object-cover border border-border">
                        @else
                            <div class="w-10 h-10 rounded-none bg-surface-2 flex items-center justify-center text-text-secondary font-mono text-sm border border-border">
                                {{ substr($article->author?->name ?? '?', 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-[13px] font-medium text-text-primary">{{ $article->author?->name ?? 'Community Member' }}</p>
                        <p class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Author</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <article class="prose prose-invert max-w-none font-sans">
                {!! \Illuminate\Support\Str::markdown($article->content) !!}
            </article>

            <!-- Footer Stats -->
            <div class="pt-10 mt-10 border-t border-border flex items-center justify-between">
                <div class="text-[11px] font-mono text-text-muted uppercase tracking-widest">
                    Views: {{ number_format($article->view_count) }}
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-muted">Was this helpful?</span>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-none border border-border hover:border-text-primary hover:text-text-primary transition-colors flex items-center justify-center text-text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                        </button>
                        <button class="w-8 h-8 rounded-none border border-border hover:border-text-primary hover:text-text-primary transition-colors flex items-center justify-center text-text-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M17 14V2"/><path d="M9 18.12 10 14H4.17a2 2 0 0 1-1.92-2.56l2.33-8A2 2 0 0 1 6.5 2H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.76a2 2 0 0 0-1.79 1.11L12 22h0a3.13 3.13 0 0 1-3-3.88Z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>