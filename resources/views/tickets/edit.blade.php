<x-layouts.app title="Edit Ticket #{{ $ticket->id }} - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <div class="flex items-center gap-2 text-xs font-black text-slate-500 uppercase tracking-[0.2em] mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                <span>Maintenance Mode</span>
            </div>
            <h1 class="text-4xl font-extrabold tracking-tight text-white">Edit Ticket <span class="text-slate-600 font-mono text-3xl ml-2">#{{ $ticket->id }}</span></h1>
            <p class="text-slate-400 mt-2 text-lg">Update the ticket details or reassignment.</p>
        </div>

        <!-- Form Container -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-2xl p-8 lg:p-10 relative overflow-hidden mb-10">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <form action="{{ route('tickets.update', [$team, $ticket]) }}" method="POST" class="space-y-10">
                @csrf
                @method('PATCH')

                <!-- Basic Info -->
                <div class="space-y-8">
                    <div class="space-y-2">
                        <label for="title" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Ticket Title</label>
                        <input type="text" name="title" id="title" required value="{{ old('title', $ticket->title) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-lg placeholder:text-slate-700">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($team->users->contains(auth()->user()))
                            <div class="space-y-2">
                                <label for="assigned_id" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Assigned Agent</label>
                                <div class="relative group">
                                    <select name="assigned_id" id="assigned_id"
                                        class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                                        <option value="">Unassigned</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ old('assigned_id', $ticket->assigned_id) == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-500 group-hover:text-slate-300 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-700 resize-none leading-relaxed"
                        >{{ old('description', $ticket->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Priority Selection -->
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Priority Level</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Low -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="priority" value="low" class="peer sr-only" {{ old('priority', $ticket->priority->value) == 'low' ? 'checked' : '' }}>
                            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-950/50 peer-checked:border-green-500/50 peer-checked:bg-green-500/5 transition-all hover:border-slate-700 flex flex-col items-center text-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-green-500/10 text-green-500 flex items-center justify-center border border-green-500/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M8 17L12 21L16 17"/><path d="M12 3V21"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-white text-sm">Low</p>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Minor Issue</p>
                                </div>
                            </div>
                        </label>

                        <!-- Medium -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="priority" value="medium" class="peer sr-only" {{ old('priority', $ticket->priority->value) == 'medium' ? 'checked' : '' }}>
                            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-950/50 peer-checked:border-orange-500/50 peer-checked:bg-orange-500/5 transition-all hover:border-slate-700 flex flex-col items-center text-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-orange-500/10 text-orange-500 flex items-center justify-center border border-orange-500/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-white text-sm">Medium</p>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Standard</p>
                                </div>
                            </div>
                        </label>

                        <!-- High -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="priority" value="high" class="peer sr-only" {{ old('priority', $ticket->priority->value) == 'high' ? 'checked' : '' }}>
                            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-950/50 peer-checked:border-red-500/50 peer-checked:bg-red-500/5 transition-all hover:border-slate-700 flex flex-col items-center text-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center border border-red-500/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7L12 3L16 7"/><path d="M12 3V21"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-white text-sm">High</p>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Urgent Fix</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex items-center justify-end gap-6 pt-10 border-t border-slate-800/50">
                    <a href="{{ route('tickets.show', [$team, $ticket]) }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                        Cancel Changes
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full transition-all shadow-xl shadow-blue-600/20 hover:scale-105 active:scale-95">
                        Update Ticket
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="bg-red-500/5 border border-red-500/20 rounded-3xl p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="text-center sm:text-left">
                <h4 class="text-lg font-bold text-red-500 tracking-tight">Danger Zone</h4>
                <p class="text-slate-500 text-sm font-medium">Once you archive this ticket, it can only be restored by an admin.</p>
            </div>
            <button 
                type="button" 
                onclick="openModal('delete-ticket-modal', '{{ route('tickets.destroy', [$team, $ticket]) }}')" 
                class="bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-widest transition-all"
            >
                Archive Ticket
            </button>
        </div>
    </div>

    <x-confirm-modal 
        id="delete-ticket-modal" 
        title="Confirm Archival" 
        message="Are you sure you want to move this ticket to history? This action is reversible by team admins." 
        confirmText="Archive Ticket" 
    />
</x-layouts.app>
