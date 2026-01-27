<x-layouts.app title="Edit Team - {{ config('app.name', 'Ticket Hub') }}" sidebar="team">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">Edit Workspace</h1>
            <p class="text-slate-400 text-lg">Manage your team's identity and privacy settings.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-xl p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <form action="{{ route('teams.update', $team) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PATCH')

                <div class="space-y-8">
                    <!-- Name & Description -->
                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Team Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" required 
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-lg placeholder:text-slate-700">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Description</label>
                        <textarea name="description" id="description" rows="4" 
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-slate-700 resize-none font-medium leading-relaxed"
                            placeholder="Briefly describe what this team is for...">{{ old('description', $team->description) }}</textarea>
                    </div>

                    <!-- Logo Input -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Team Logo</label>
                        
                        <div class="flex items-center gap-8 p-6 rounded-3xl bg-slate-950/50 border border-slate-800/50">
                            <!-- Current Preview -->
                            <div class="flex-shrink-0">
                                @if($team->logo)
                                    <img src="{{ asset('storage/' . $team->logo) }}" 
                                         alt="{{ $team->name }} Logo" 
                                         class="w-24 h-24 rounded-3xl object-cover border-2 border-slate-800 shadow-2xl">
                                @else
                                    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center border-2 border-slate-800 shadow-2xl">
                                        <span class="text-3xl font-black text-slate-700 uppercase">{{ substr($team->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- File Input -->
                            <div class="flex-grow">
                                <label class="block mb-2">
                                    <span class="sr-only">Choose team logo</span>
                                    <input type="file" 
                                           name="logo" 
                                           id="logo" 
                                           accept="image/*"
                                           class="block w-full text-sm text-slate-400
                                                  file:mr-4 file:py-2.5 file:px-6
                                                  file:rounded-xl file:border-0
                                                  file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                                  file:bg-blue-600 file:text-white
                                                  hover:file:bg-blue-500
                                                  cursor-pointer transition-all">
                                </label>
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tight ml-1">JPG, PNG or GIF • Max 1MB</p>
                            </div>
                        </div>
                        @error('logo') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-6 bg-slate-950/50 rounded-3xl border border-slate-800/50">
                        <div>
                            <h4 class="font-bold text-white mb-1">Private Workspace</h4>
                            <p class="text-xs font-medium text-slate-500">Only invited members can find and join this team.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" id="is_private" value="1" class="sr-only peer" {{ old('is_private', $team->is_private) ? 'checked' : '' }}>
                            <div class="w-14 h-8 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-slate-400 after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 peer-checked:after:bg-white peer-checked:after:border-white"></div>
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-6 pt-10 border-t border-slate-800/50">
                    <a href="{{ route('teams.show', $team) }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full transition-all shadow-xl shadow-blue-600/20 hover:scale-105 active:scale-95">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>