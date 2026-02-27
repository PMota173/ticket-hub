<x-layouts.app title="Create Team - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Create New Workspace</h1>
            <p class="text-text-secondary text-[13px]">Establish a dedicated hub for your support tickets and collaboration.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <form action="/teams" method="POST" class="space-y-8">
                @csrf

                <div class="space-y-6">
                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Team Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Acme Corp Support"
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-2.5 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 text-[13px] placeholder-text-muted">
                        @error('name') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-1.5">
                        <label for="description" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-3 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder-text-muted resize-none text-[13px] leading-relaxed"
                            placeholder="Briefly describe what this team is for...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-5 bg-surface-2 rounded-[6px] border border-border">
                        <div>
                            <h4 class="text-[13px] font-medium text-text-primary mb-1">Private Workspace</h4>
                            <p class="text-[12px] text-text-secondary max-w-sm leading-relaxed">
                                Hidden from the public Explore directory. Only invited members can view and access this workspace. You can change this setting later.
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" id="is_private" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-surface-3 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-text-secondary after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-accent peer-checked:after:bg-white"></div>
                        </label>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-[6px] bg-accent/5 border border-accent/10">
                        <div class="text-accent mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <div class="text-[13px] text-text-secondary leading-relaxed">
                            You will automatically be assigned as the <strong class="text-text-primary font-medium">Admin</strong> of this team. You can invite other members later.
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-border mt-8">
                    <a href="/teams" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                        Cancel
                    </a>
                    <x-blue-button type="submit">
                        Create Workspace
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
