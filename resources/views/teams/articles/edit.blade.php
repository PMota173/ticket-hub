<x-layouts.app title="Edit Article - {{ $article->title }}" sidebar="team">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div class="flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-widest mb-2">
                <a href="{{ route('articles.index', $team) }}" class="hover:text-text-primary transition-colors flex items-center gap-1">
                    Knowledge Base
                </a>
                <span>/</span>
                <span class="text-text-secondary">Edit_</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary">Edit Article</h1>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('portal.articles.show', [$team, $article]) }}" target="_blank" class="text-[10px] font-mono text-text-secondary uppercase tracking-widest hover:text-text-primary hover:underline flex items-center gap-1">
                        [ View Article ]
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                    </a>
                    <form action="{{ route('articles.destroy', [$team, $article]) }}" method="POST" onsubmit="return confirm('Archive this article? This cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[10px] font-mono text-danger uppercase tracking-widest hover:underline">
                            [ Delete Article ]
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('articles.update', [$team, $article]) }}" method="POST" class="space-y-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            @csrf
            @method('PATCH')

            <div class="bg-surface-1 border border-border p-8 space-y-6">
                <div class="space-y-1.5">
                    <label for="title" class="block text-[11px] font-mono text-text-muted uppercase tracking-widest">Article Title</label>
                    <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}"
                        class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent transition-all duration-150 text-sm font-sans"
                        placeholder="e.g., How to configure your API keys">
                    @error('title') <p class="text-danger font-mono text-[10px] mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="content" class="block text-[11px] font-mono text-text-muted uppercase tracking-widest">Content (Markdown Supported)</label>
                    <textarea name="content" id="content" rows="15" required
                        class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-3 focus:outline-none focus:ring-0 focus:border-accent transition-all duration-150 placeholder-text-muted resize-none text-sm leading-relaxed font-sans"
                        placeholder="Write your article content here...">{{ old('content', $article->content) }}</textarea>
                    @error('content') <p class="text-danger font-mono text-[10px] mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-border flex items-center gap-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 rounded-none bg-surface-3 border-border text-accent focus:ring-accent focus:ring-offset-bg">
                    <label for="is_published" class="text-xs font-mono text-text-secondary uppercase tracking-widest cursor-pointer select-none">Article is published</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('articles.index', $team) }}" class="text-[11px] font-mono uppercase tracking-widest text-text-muted hover:text-text-primary transition-colors">
                    Cancel
                </a>
                <x-blue-button type="submit">
                    Update Article_
                </x-blue-button>
            </div>
        </form>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>