<x-layouts.app title="Knowledge Base" sidebar="team">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Knowledge Base</h1>
                <p class="text-text-secondary text-sm">Manage public guides and documentation for your workspace.</p>
            </div>
            <a href="{{ route('articles.create', $team) }}" class="inline-flex items-center justify-center gap-2 bg-text-primary hover:bg-text-secondary text-bg px-4 py-2 text-sm font-medium transition-colors duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                New Article
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 bg-success/10 border border-success/20 text-success p-4 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span class="font-medium text-sm">{{ session('status') }}</span>
            </div>
        @endif

        <!-- Articles List -->
        <div class="bg-surface-1 border border-border opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            @if($articles->isEmpty())
                <div class="p-12 text-center flex flex-col items-center">
                    <div class="w-12 h-12 bg-surface-2 border border-border flex items-center justify-center mb-4 text-text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M8 7h6"/><path d="M8 11h8"/></svg>
                    </div>
                    <h3 class="text-text-primary font-medium mb-1">No articles yet</h3>
                    <p class="text-text-secondary text-sm mb-6 max-w-sm">Create guides to help your community find answers before submitting a ticket.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-border bg-surface-2 text-[10px] font-mono uppercase tracking-widest text-text-muted">
                                <th class="p-4 font-normal">Title</th>
                                <th class="p-4 font-normal">Author</th>
                                <th class="p-4 font-normal">Status</th>
                                <th class="p-4 font-normal">Views</th>
                                <th class="p-4 font-normal text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @foreach($articles as $article)
                                <tr class="group hover:bg-surface-2 transition-colors duration-150">
                                    <td class="p-4">
                                        <div class="font-medium text-text-primary text-sm group-hover:text-accent transition-colors duration-150">{{ $article->title }}</div>
                                        <div class="text-[11px] font-mono text-text-muted mt-1">{{ $article->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 bg-surface-3 border border-border flex items-center justify-center text-[10px] font-mono text-text-secondary">
                                                {{ substr($article->author->name, 0, 1) }}
                                            </div>
                                            <span class="text-xs text-text-secondary">{{ $article->author->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        @if($article->is_published)
                                            <span class="inline-flex items-center px-2 py-0.5 border border-success/30 bg-success/5 text-success text-[10px] font-mono uppercase tracking-widest">
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 border border-warning/30 bg-warning/5 text-warning text-[10px] font-mono uppercase tracking-widest">
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-xs text-text-secondary font-mono">
                                        {{ number_format($article->view_count) }}
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('portal.articles.show', [$team, $article]) }}" target="_blank" class="inline-flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-widest hover:text-text-primary transition-colors duration-150 group-hover:bg-surface-3 px-3 py-1.5 border border-transparent group-hover:border-border">
                                                View_
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                                            </a>
                                            <a href="{{ route('articles.edit', [$team, $article]) }}" class="inline-flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-widest hover:text-text-primary transition-colors duration-150 group-hover:bg-surface-3 px-3 py-1.5 border border-transparent group-hover:border-border">
                                                Edit_
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>