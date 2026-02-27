<x-layouts.app title="Team Robots - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Automation Robots</h1>
                <p class="text-text-secondary text-[13px]">Create API clients to automate ticket creation and management.</p>
            </div>
            
            <div class="inline-flex items-center gap-3 bg-surface-1 border border-border rounded-[6px] px-3 py-1.5">
                <span class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Capacity</span>
                <span class="text-[11px] font-mono font-medium {{ $robots->count() >= 3 ? 'text-danger' : 'text-accent' }}">
                    {{ $robots->count() }} / 3
                </span>
            </div>
        </div>

        @if (session('robot_token'))
            <div class="mb-8 bg-success/5 border border-success/20 rounded-[8px] p-6 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                <h3 class="text-[15px] font-medium text-success mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                    Secret Key Generated
                </h3>
                <p class="text-text-secondary text-[13px] mb-4">This token will only be shown once. Copy it now to secure your integration.</p>
                <div class="flex items-center gap-3 bg-bg p-1.5 rounded-[6px] border border-border">
                    <div id="api-token" class="font-mono text-[13px] break-all text-accent select-all flex-grow px-3 py-2">
                        {{ session('robot_token') }}
                    </div>
                    <button
                        onclick="copyToClipboard('api-token', this)"
                        class="flex-shrink-0 p-2 text-text-muted hover:text-text-primary bg-surface-2 hover:bg-surface-3 rounded-[4px] transition-all duration-150 border border-border"
                        title="Copy to clipboard"
                    >
                        <svg id="copy-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        <svg id="check-icon" class="hidden text-success" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <!-- Create Robot Form -->
            <div class="lg:col-span-1">
                <div class="bg-surface-1 border border-border rounded-[8px] p-6 sticky top-8">
                    <h3 class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-6">New Integration</h3>
                    
                    @if($robots->count() >= 3)
                        <div class="bg-warning/5 border border-warning/20 rounded-[6px] p-4 mb-6">
                            <p class="text-[12px] text-warning leading-relaxed">Workspace limit reached. Delete an existing robot to create a new one.</p>
                        </div>
                    @endif

                    <form action="{{ route('robots.store', $team) }}" method="POST" @if($robots->count() >= 3) class="opacity-50 pointer-events-none" @endif>
                        @csrf
                        <div class="space-y-5">
                            <div class="space-y-1.5">
                                <label for="name" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Bot Identity</label>
                                <input type="text" name="name" id="name" required placeholder="e.g., CI/CD Pipeline" 
                                    @if($robots->count() >= 3) disabled @endif
                                    class="w-full bg-surface-2 border border-border rounded-[6px] px-4 py-2.5 text-text-primary placeholder-text-muted focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] text-[13px] transition-all duration-150">
                                @error('name')
                                    <p class="mt-2 text-[11px] font-mono text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-blue-button type="submit" class="w-full" :disabled="$robots->count() >= 3">
                                Initialize Robot
                            </x-blue-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Robots List -->
            <div class="lg:col-span-2">
                <div class="bg-surface-1 border border-border rounded-[8px] overflow-hidden">
                    <div class="px-6 py-4 border-b border-border bg-surface-2">
                        <h3 class="text-[11px] font-mono text-text-primary uppercase tracking-[0.08em]">Active Clients</h3>
                    </div>

                    @if($robots->isEmpty())
                        <div class="p-16 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-[6px] bg-surface-2 text-text-muted mb-4 border border-border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                            </div>
                            <h3 class="text-[15px] font-medium text-text-primary mb-1">No robots configured</h3>
                            <p class="text-text-secondary text-[13px] max-w-sm mx-auto">Create your first robot to generate an API key for automated workflows.</p>
                        </div>
                    @else
                        <div class="divide-y divide-border">
                            @foreach($robots as $robot)
                                <div class="px-6 py-5 flex items-start justify-between group hover:bg-surface-2/50 transition-colors duration-150">
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-[4px] bg-surface-2 border border-border flex items-center justify-center text-text-secondary group-hover:text-accent transition-colors duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-[15px] font-medium text-text-primary mb-1">{{ $robot->name }}</h4>
                                            <div class="text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">
                                                Initialized {{ $robot->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity duration-150">
                                        <button 
                                            onclick="openModal('delete-robot-{{ $robot->id }}', '{{ route('robots.destroy', [$team, $robot]) }}')"
                                            class="p-2 text-text-muted hover:text-danger hover:bg-danger/10 rounded-[4px] transition-all duration-150" 
                                            title="Revoke Access">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <x-confirm-modal
                                    id="delete-robot-{{ $robot->id }}"
                                    title="Revoke Robot Access"
                                    message="Are you sure you want to delete '{{ $robot->name }}'? Any automated systems using this token will immediately lose access."
                                    confirmText="Revoke Access"
                                />
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(elementId, button) {
            const text = document.getElementById(elementId).innerText.trim();

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    showCheckIcon(button);
                });
            } else {
                let textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-9999px";
                textArea.style.top = "0";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    showCheckIcon(button);
                } catch (err) {
                    console.error('Fallback copy failed', err);
                }
                document.body.removeChild(textArea);
            }
        }

        function showCheckIcon(button) {
            const copyIcon = button.querySelector('#copy-icon');
            const checkIcon = button.querySelector('#check-icon');

            copyIcon.classList.add('hidden');
            checkIcon.classList.remove('hidden');

            setTimeout(() => {
                copyIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }, 2000);
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
