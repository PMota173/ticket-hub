<x-layouts.app title="Edit Member - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <div>
                <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Edit Member</h1>
                <p class="text-text-secondary text-[13px]">Manage roles and permissions for {{ $member->name }}.</p>
            </div>
            <a href="{{ route('members.show', [$team, $member]) }}" class="inline-flex items-center gap-2 text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                Cancel
            </a>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 bg-danger/10 border border-danger/20 rounded-[6px] text-danger text-[13px] font-medium flex items-center gap-3 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <div class="flex items-center gap-6 mb-8 pb-6 border-b border-border">
                <div class="w-16 h-16 rounded-[6px] bg-surface-2 flex items-center justify-center text-text-secondary text-2xl font-mono font-medium border border-border">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-[15px] font-medium text-text-primary mb-1">{{ $member->name }}</h3>
                    <p class="text-text-secondary font-mono text-[13px]">{{ $member->email }}</p>
                    <p class="text-[10px] text-text-muted mt-2 font-mono uppercase tracking-[0.08em]">Joined {{ $member_since->format('M d, Y') }}</p>
                </div>
            </div>

            <form action="{{ route('members.update', [$team, $member]) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em] mb-4">Access Level</label>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Regular Member -->
                        <label class="relative flex cursor-pointer rounded-[6px] border border-border bg-surface-2 p-5 transition-all duration-150 has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:shadow-[0_0_0_1px_var(--color-accent)] group">
                            <input type="radio" name="is_admin" value="0" class="sr-only peer" {{ !$team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-[13px] font-medium text-text-primary mb-1 group-hover:text-accent transition-colors">Member</span>
                                    <span class="text-[12px] text-text-secondary leading-relaxed">
                                        Standard access. Can view, create, and comment on tickets within this workspace.
                                    </span>
                                </span>
                            </span>
                            <div class="absolute top-5 right-5">
                                <div class="w-4 h-4 rounded-full border border-border-light peer-checked:border-accent peer-checked:bg-accent transition-all flex items-center justify-center">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                </div>
                            </div>
                        </label>

                        <!-- Admin -->
                        <label class="relative flex cursor-pointer rounded-[6px] border border-border bg-surface-2 p-5 transition-all duration-150 has-[:checked]:border-accent has-[:checked]:bg-accent/5 has-[:checked]:shadow-[0_0_0_1px_var(--color-accent)] group">
                            <input type="radio" name="is_admin" value="1" class="sr-only peer" {{ $team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-[13px] font-medium text-text-primary mb-1 group-hover:text-accent transition-colors">Admin</span>
                                    <span class="text-[12px] text-text-secondary leading-relaxed">
                                        Full control. Can manage workspace settings, invite users, and modify roles.
                                    </span>
                                </span>
                            </span>
                            <div class="absolute top-5 right-5">
                                <div class="w-4 h-4 rounded-full border border-border-light peer-checked:border-accent peer-checked:bg-accent transition-all flex items-center justify-center">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('is_admin')
                        <p class="mt-3 text-[11px] font-mono text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-border mt-8 flex justify-end">
                    <x-blue-button type="submit" class="w-full sm:w-auto">
                        Update Permissions
                    </x-blue-button>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="mt-10 pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="text-center sm:text-left">
                    <h4 class="text-danger font-mono text-[11px] uppercase tracking-[0.08em] mb-1">Danger Zone</h4>
                    <p class="text-text-secondary text-[12px]">Revoke access immediately. This action cannot be undone.</p>
                </div>
                <button
                    type="button"
                    onclick="openModal('remove-member-modal', '{{ route('members.destroy', [$team, $member]) }}')"
                    class="px-5 py-2.5 text-[11px] font-mono uppercase tracking-[0.08em] text-danger border border-danger/20 rounded-[6px] hover:bg-danger/10 transition-all duration-150"
                >
                    Remove Member
                </button>
            </div>
        </div>
    </div>

    <x-confirm-modal
        id="remove-member-modal"
        title="Remove Member"
        message="Are you sure you want to remove {{ $member->name }} from the team? This action cannot be undone."
        confirmText="Remove Member"
    />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</x-layouts.app>
