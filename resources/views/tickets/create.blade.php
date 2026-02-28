<x-layouts.app title="Create Ticket - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div class="flex items-center gap-2 text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/></svg>
                <span>Process Flow</span>
            </div>
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Create New Ticket</h1>
            <p class="text-text-secondary text-[13px]">Define the issue and assign it to the right team member.</p>
        </div>

        <!-- Form Container -->
        <div class="bg-surface-1 border border-border rounded-none p-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <form action="{{ route('tickets.store', $team) }}" method="POST" class="space-y-8">
                @csrf

                <!-- Basic Info -->
                <div class="space-y-6">
                    <div class="space-y-1.5">
                        <label for="title" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Issue Overview</label>
                        <input type="text" name="title" id="title" required value="{{ old('title') }}"
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 text-[13px] placeholder-text-muted"
                            placeholder="What needs attention?">
                        @error('title') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($team->users->contains(auth()->user()))
                            <div class="space-y-1.5">
                                <label for="assigned_id" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Assign to Agent</label>
                                <div class="relative group">
                                    <select name="assigned_id" id="assigned_id"
                                        class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 appearance-none cursor-pointer text-[13px]">
                                        <option value="">Unassigned</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ old('assigned_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-text-muted group-hover:text-text-primary transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <label for="description" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Context & Details</label>
                        <textarea name="description" id="description" rows="6" required
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-3 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder-text-muted resize-none text-[13px] leading-relaxed"
                            placeholder="Provide full context, reproduction steps, etc.">{{ old('description') }}</textarea>
                        @error('description') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Priority Selection -->
                <div class="space-y-4">
                    <label class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Priority Level</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Low -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="low" class="peer sr-only" {{ old('priority', 'low') == 'low' ? 'checked' : '' }}>
                            <div class="p-4 rounded-none border border-border bg-surface-2 peer-checked:border-accent peer-checked:bg-accent/5 transition-all duration-150 hover:border-border-light flex flex-col items-center text-center gap-3">
                                <div class="text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m19 12-7 7-7-7"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-text-primary text-[13px]">Low</p>
                                    <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Standard</p>
                                </div>
                            </div>
                        </label>

                        <!-- Medium -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="medium" class="peer sr-only" {{ old('priority') == 'medium' ? 'checked' : '' }}>
                            <div class="p-4 rounded-none border border-border bg-surface-2 peer-checked:border-accent peer-checked:bg-accent/5 transition-all duration-150 hover:border-border-light flex flex-col items-center text-center gap-3">
                                <div class="text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-text-primary text-[13px]">Medium</p>
                                    <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Elevated</p>
                                </div>
                            </div>
                        </label>

                        <!-- High -->
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="priority" value="high" class="peer sr-only" {{ old('priority') == 'high' ? 'checked' : '' }}>
                            <div class="p-4 rounded-none border border-border bg-surface-2 peer-checked:border-accent peer-checked:bg-accent/5 transition-all duration-150 hover:border-border-light flex flex-col items-center text-center gap-3">
                                <div class="text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-text-primary text-[13px]">High</p>
                                    <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">Critical</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-border mt-8">
                    <a href="{{ route('tickets.index', $team) }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                        Discard
                    </a>
                    <x-blue-button type="submit">
                        Initialize Ticket
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
