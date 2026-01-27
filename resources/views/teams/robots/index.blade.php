<x-layouts.app title="Team Robots - {{ $team->name }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold tracking-tight text-white">Team Robots</h2>
            <p class="text-slate-400 mt-2">Manage automated API clients for your team.</p>
        </div>
        <div class="bg-slate-900/50 border border-slate-700 rounded-lg px-4 py-2">
            <span class="text-sm font-medium text-slate-400">Usage: </span>
            <span class="text-sm font-bold {{ $robots->count() >= 3 ? 'text-red-400' : 'text-blue-400' }}">
                {{ $robots->count() }} / 3
            </span>
        </div>
    </div>

    @if (session('robot_token'))
        <div class="mb-8 bg-green-900/30 border border-green-500/50 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-green-400 mb-2">API Token Generated</h3>
            <p class="text-slate-300 mb-4">Please copy this token now. It will not be shown again.</p>
            <div class="flex items-center gap-3 bg-slate-950 p-4 rounded-lg border border-slate-800">
                <div id="api-token" class="font-mono text-sm break-all text-green-300 select-all flex-grow">
                    {{ session('robot_token') }}
                </div>
                <button
                    onclick="copyToClipboard('api-token', this)"
                    class="flex-shrink-0 p-2 text-slate-400 hover:text-white bg-slate-800 hover:bg-slate-700 rounded-md transition-all"
                    title="Copy to clipboard"
                >
                    <svg id="copy-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                    <svg id="check-icon" class="hidden text-green-400" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Create Robot Form -->
        <div class="lg:col-span-1">
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-white mb-4">Create New Robot</h3>
                
                @if($robots->count() >= 3)
                    <div class="bg-amber-900/20 border border-amber-500/30 rounded-lg p-4 mb-4">
                        <div class="flex gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-500 flex-shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            <p class="text-sm text-amber-200/80">Maximum limit of 3 robots reached for this team.</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('robots.store', $team) }}" method="POST" @if($robots->count() >= 3) class="opacity-50 pointer-events-none" @endif>
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-400 mb-1">Robot Name</label>
                            <input type="text" name="name" id="name" required placeholder="e.g. CI Monitor" 
                                @if($robots->count() >= 3) disabled @endif
                                class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" 
                            @if($robots->count() >= 3) disabled @endif
                            class="w-full bg-blue-600 hover:bg-blue-500 disabled:bg-slate-800 disabled:text-slate-500 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors">
                            Create Robot
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Robots List -->
        <div class="lg:col-span-2">
            <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-700">
                    <h3 class="text-lg font-semibold text-white">Active Robots</h3>
                </div>

                @if($robots->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-800 text-slate-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-2">No robots yet</h3>
                        <p class="text-slate-400 max-w-sm mx-auto">Create a robot to generate an API token for automated integrations.</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-800">
                        @foreach($robots as $robot)
                            <div class="p-6 flex items-start justify-between group hover:bg-slate-800/30 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bot"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-white">{{ $robot->name }}</h4>
                                        <div class="flex items-center gap-4 mt-2 text-xs text-slate-500">
                                            <span>Created {{ $robot->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                                                <div class="flex items-center gap-2">
                                                                    <button 
                                                                        onclick="openModal('delete-robot-{{ $robot->id }}', '{{ route('robots.destroy', [$team, $robot]) }}')"
                                                                        class="p-2 text-slate-400 hover:text-red-400 transition-colors rounded-lg hover:bg-red-500/10" 
                                                                        title="Delete Robot">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                                    </button>
                                                                </div>                            </div>

                            <x-confirm-modal
                                id="delete-robot-{{ $robot->id }}"
                                title="Delete Robot"
                                message="Are you sure you want to delete '{{ $robot->name }}'? This action cannot be undone and any integrations using this robot's token will stop working."
                                confirmText="Delete Robot"
                                action="{{ route('robots.destroy', [$team, $robot]) }}"
                                method="DELETE"
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(elementId, button) {
            const text = document.getElementById(elementId).innerText.trim();

            if (navigator.clipboard && window.isSecureContext) {
                // Navigator clipboard api method'
                navigator.clipboard.writeText(text).then(() => {
                    showCheckIcon(button);
                });
            } else {
                // Text area method
                let textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-9999px";
                textArea.style.top = "0";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                return new Promise((res, rej) => {
                    document.execCommand('copy') ? res() : rej();
                    textArea.remove();
                    showCheckIcon(button);
                });
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
