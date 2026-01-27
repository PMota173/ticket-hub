<x-layouts.app title="Edit Member - {{ $member->name }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-12 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">Edit Member</h1>
                <p class="text-slate-400 text-lg">Manage roles and permissions for {{ $member->name }}.</p>
            </div>
            <x-back-button href="{{ route('members.show', [$team, $member]) }}">Cancel</x-back-button>
        </div>

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-sm font-bold flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] shadow-xl p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

            <div class="flex items-center gap-6 mb-10 pb-8 border-b border-slate-800/50">
                <div class="w-20 h-20 rounded-[1.5rem] bg-slate-800 flex items-center justify-center text-slate-400 text-3xl font-black border-2 border-slate-700 shadow-inner">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white mb-1">{{ $member->name }}</h3>
                    <p class="text-slate-400 font-medium">{{ $member->email }}</p>
                    <p class="text-xs text-slate-500 mt-2 font-bold uppercase tracking-widest">Joined {{ $member_since->format('M d, Y') }}</p>
                </div>
            </div>

            <form action="{{ route('members.update', [$team, $member]) }}" method="POST" class="space-y-10">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1 mb-4 block">Access Level</label>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Regular Member -->
                        <label class="relative flex cursor-pointer rounded-2xl border border-slate-800 bg-slate-950 p-6 shadow-sm focus:outline-none hover:border-slate-600 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/5 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 group">
                            <input type="radio" name="is_admin" value="0" class="sr-only peer" {{ !$team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-sm font-black text-white uppercase tracking-wider group-hover:text-blue-400 transition-colors">Member</span>
                                    <span class="mt-2 flex items-center text-xs text-slate-500 leading-relaxed font-medium">
                                        Standard access. Can view, create, and comment on tickets within this workspace.
                                    </span>
                                </span>
                            </span>
                            <div class="absolute top-6 right-6">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-700 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-all"></div>
                            </div>
                        </label>

                        <!-- Admin -->
                        <label class="relative flex cursor-pointer rounded-2xl border border-slate-800 bg-slate-950 p-6 shadow-sm focus:outline-none hover:border-slate-600 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/5 has-[:checked]:ring-1 has-[:checked]:ring-blue-500 group">
                            <input type="radio" name="is_admin" value="1" class="sr-only peer" {{ $team->hasAdmin($member) ? 'checked' : '' }}>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span class="block text-sm font-black text-blue-400 uppercase tracking-wider">Admin</span>
                                    <span class="mt-2 flex items-center text-xs text-slate-500 leading-relaxed font-medium">
                                        Full control. Can manage workspace settings, invite users, and modify roles.
                                    </span>
                                </span>
                            </span>
                            <div class="absolute top-6 right-6">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-700 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-all"></div>
                            </div>
                        </label>
                    </div>
                    @error('is_admin')
                        <p class="mt-3 text-xs font-bold text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-slate-800/50">
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-8 py-4 text-xs font-black uppercase tracking-[0.2em] text-white bg-blue-600 rounded-full hover:bg-blue-500 shadow-xl shadow-blue-600/20 transition-all duration-200 hover:scale-[1.02]">
                        Update Permissions
                    </button>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="mt-12 pt-10 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="text-center sm:text-left">
                    <h4 class="text-red-500 font-black text-sm uppercase tracking-widest mb-1">Danger Zone</h4>
                    <p class="text-slate-500 text-xs font-medium">Revoke access immediately. This action cannot be undone.</p>
                </div>
                <button
                    type="button"
                    onclick="openModal('remove-member-modal', '{{ route('members.destroy', [$team, $member]) }}')"
                    class="px-6 py-3 text-xs font-black uppercase tracking-widest text-red-500 border border-red-500/20 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-200"
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