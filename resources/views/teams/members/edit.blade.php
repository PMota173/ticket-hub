<x-layouts.app title="Edit Member - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-white">Edit Member</h1>
                <p class="text-slate-400 mt-2">Manage roles and permissions for {{ $member->name }}.</p>
            </div>
            <x-back-button href="{{ route('members.show', [$team, $member]) }}">Cancel</x-back-button>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-slate-800">
                <div class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 text-xl font-bold border border-slate-700">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">{{ $member->name }}</h3>
                    <p class="text-sm text-slate-400">{{ $member->email }}</p>
                    <p class="text-xs text-slate-500 mt-1">Joined {{ $member_since->format('M d, Y') }}</p>
                </div>
            </div>

            <form action="{{ route('members.update', [$team, $member]) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-base font-semibold text-white">Team Role</label>
                    <p class="text-sm text-slate-400 mb-4">Admins can manage team settings and members.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Regular Member -->
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-700 bg-slate-950 p-4 shadow-sm focus:outline-none hover:border-slate-600 transition-all has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                            <input type="radio" name="is_admin" value="0" class="sr-only" {{ !$team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-sm font-bold text-white uppercase tracking-wider">Member</span>
                                    <span class="mt-1 flex items-center text-xs text-slate-500">
                                        Can view and create tickets in the team workspace.
                                    </span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-blue-500 invisible [.peer:checked~&]:visible" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </label>

                        <!-- Admin -->
                        <label class="relative flex cursor-pointer rounded-xl border border-slate-700 bg-slate-950 p-4 shadow-sm focus:outline-none hover:border-slate-600 transition-all has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500">
                            <input type="radio" name="is_admin" value="1" class="sr-only" {{ $team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-sm font-bold text-blue-400 uppercase tracking-wider">Admin</span>
                                    <span class="mt-1 flex items-center text-xs text-slate-500">
                                        Full access to manage members and team settings.
                                    </span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-blue-500 invisible [.peer:checked~&]:visible" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </label>
                    </div>
                    @error('is_admin')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-500 shadow-lg shadow-blue-500/10 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>
                        Update Member Role
                    </button>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="mt-12 pt-8 border-t border-slate-800 flex items-center justify-between">
                <div class="text-sm">
                    <h4 class="text-white font-semibold">Danger Zone</h4>
                    <p class="text-slate-400">Remove this member from the team. They will lose all access.</p>
                </div>
                <button
                    type="button"
                    onclick="openModal('remove-member-modal', '{{ route('members.destroy', [$team, $member]) }}')"
                    class="px-4 py-2 text-sm font-semibold text-red-500 border border-red-500/30 rounded-lg hover:bg-red-500/10 transition-all duration-200"
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
</x-layouts.app>
