<x-layouts.app title="Team Robots - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-white mb-2">Automation Robots</h2>
                <p class="text-slate-400 text-lg">Create API clients to automate ticket creation and management.</p>
            </div>
            
            <div class="inline-flex items-center gap-3 bg-slate-900/50 border border-slate-800 rounded-full pl-4 pr-1 py-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Capacity</span>
                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-black {{ $robots->count() >= 3 ? 'bg-red-500/10 text-red-400' : 'bg-blue-500/10 text-blue-400' }}">
                    {{ $robots->count() }} / 3
                </span>
            </div>
        </div>

        @if (session('robot_token'))
            <div class="mb-10 bg-emerald-500/5 border border-emerald-500/20 rounded-[2rem] p-8 animate-fade-in-down shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500"></div>
                <h3 class="text-lg font-bold text-emerald-400 mb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                    Secret Key Generated
                </h3>
                <p class="text-slate-400 text-sm mb-6 font-medium">This token will only be shown once. Copy it now to secure your integration.</p>
                <div class="flex items-center gap-4 bg-slate-950 p-2 rounded-2xl border border-slate-800 shadow-inner">
                    <div id="api-token" class="font-mono text-sm break-all text-emerald-300 select-all flex-grow px-4 py-2">
                        {{ session('robot_token') }}
                    </div>
                    <button
                        onclick="copyToClipboard('api-token', this)"
                        class="flex-shrink-0 p-3 text-slate-400 hover:text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all border border-slate-800 hover:border-slate-700"
                        title="Copy to clipboard"
                    >
                        <svg id="copy-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        <svg id="check-icon" class="hidden text-emerald-400" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><polyline points="20 6 9 17 4 12"/></svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Create Robot Form -->
            <div class="lg:col-span-1">
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden p-8 sticky top-8">
                    <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-6">New Integration</h3>
                    
                    @if($robots->count() >= 3)
                        <div class="bg-amber-500/5 border border-amber-500/20 rounded-2xl p-5 mb-6">
                            <div class="flex gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500 flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                <p class="text-xs font-bold text-amber-200/80 leading-relaxed">Workspace limit reached. Delete an existing robot to create a new one.</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('robots.store', $team) }}" method="POST" @if($robots->count() >= 3) class="opacity-50 pointer-events-none" @endif>
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 ml-1">Bot Identity</label>
                                <input type="text" name="name" id="name" required placeholder="e.g., CI/CD Pipeline" 
                                    @if($robots->count() >= 3) disabled @endif
                                    class="w-full bg-slate-950 border border-slate-800 rounded-2xl px-5 py-3.5 text-white placeholder-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 font-bold transition-all">
                                @error('name')
                                    <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" 
                                @if($robots->count() >= 3) disabled @endif
                                class="w-full bg-blue-600 hover:bg-blue-500 disabled:bg-slate-800 disabled:text-slate-600 text-white text-xs font-black uppercase tracking-[0.2em] py-4 rounded-full transition-all shadow-lg hover:scale-105 active:scale-95">
                                Initialize Robot
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Robots List -->
            <div class="lg:col-span-2">
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl overflow-hidden">
                    <div class="p-8 border-b border-slate-800 bg-slate-900/80">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Active Clients</h3>
                    </div>

                    @if($robots->isEmpty())
                        <div class="p-16 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-[2rem] bg-slate-800/50 text-slate-600 mb-6 border border-slate-700/50 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2 tracking-tight">No robots configured</h3>
                            <p class="text-slate-500 max-w-sm mx-auto font-medium">Create your first robot to generate an API key for automated workflows.</p>
                        </div>
                    @else
                        <div class="divide-y divide-slate-800/50">
                            @foreach($robots as $robot)
                                <div class="p-8 flex items-start justify-between group hover:bg-slate-800/30 transition-colors">
                                    <div class="flex items-start gap-6">
                                        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 shadow-lg group-hover:scale-110 transition-transform">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-white mb-1">{{ $robot->name }}</h4>
                                            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                                <span>Initialized {{ $robot->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button 
                                            onclick="openModal('delete-robot-{{ $robot->id }}', '{{ route('robots.destroy', [$team, $robot]) }}')"
                                            class="p-3 text-slate-500 hover:text-red-400 transition-all rounded-xl hover:bg-red-500/10 border border-transparent hover:border-red-500/20" 
                                            title="Revoke Access">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <x-confirm-modal
                                    id="delete-robot-{{ $robot->id }}"
                                    title="Revoke Robot Access"
                                    message="Are you sure you want to delete '{{ $robot->name }}'? Any automated systems using this token will immediately lose access."
                                    confirmText="Revoke Access"
                                    action="{{ route('robots.destroy', [$team, $robot]) }}"
                                    method="DELETE"
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
</x-layouts.app>