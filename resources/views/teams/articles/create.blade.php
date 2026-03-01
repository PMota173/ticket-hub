<x-layouts.app title="New Article" sidebar="team">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div class="flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-widest mb-2">
                <a href="{{ route('articles.index', $team) }}" class="hover:text-text-primary transition-colors flex items-center gap-1">
                    Knowledge Base
                </a>
                <span>/</span>
                <span class="text-text-secondary">New_</span>
            </div>
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary">Create Article</h1>
        </div>

        <form action="{{ route('articles.store', $team) }}" method="POST" class="space-y-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            @csrf

            <div class="bg-surface-1 border border-border p-8 space-y-6">
                <div class="space-y-1.5">
                    <label for="title" class="block text-[11px] font-mono text-text-muted uppercase tracking-widest">Article Title</label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                        class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent transition-all duration-150 text-sm font-sans"
                        placeholder="e.g., How to configure your API keys">
                    @error('title') <p class="text-danger font-mono text-[10px] mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="content" class="block text-[11px] font-mono text-text-muted uppercase tracking-widest">Content (Markdown Supported)</label>
                    <textarea name="content" id="content" rows="15" required
                        class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-3 focus:outline-none focus:ring-0 focus:border-accent transition-all duration-150 placeholder-text-muted resize-none text-sm leading-relaxed font-sans"
                        placeholder="Write your article content here...">{{ old('content') }}</textarea>
                    @error('content') <p class="text-danger font-mono text-[10px] mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-border flex items-center gap-3">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="w-4 h-4 rounded-none bg-surface-3 border-border text-accent focus:ring-accent focus:ring-offset-bg">
                    <label for="is_published" class="text-xs font-mono text-text-secondary uppercase tracking-widest cursor-pointer select-none">Publish immediately</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('articles.index', $team) }}" class="text-[11px] font-mono uppercase tracking-widest text-text-muted hover:text-text-primary transition-colors">
                    Cancel
                </a>
                <x-blue-button type="submit">
                    Save Article_
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