<x-layouts.app title="Create Team - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">Create New Workspace</h1>
            <p class="text-slate-400 text-lg font-medium">Establish a dedicated hub for your support tickets and collaboration.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-xl p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>

            <form action="/teams" method="POST" class="space-y-10">
                @csrf

                <div class="space-y-8">
                    <!-- Name & Description -->
                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Team Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Acme Corp Support"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-lg placeholder:text-slate-700">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-slate-700 resize-none font-medium leading-relaxed"
                            placeholder="Briefly describe what this team is for...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-6 bg-slate-950/50 rounded-3xl border border-slate-800/50">
                        <div>
                            <h4 class="font-bold text-white mb-1">Private Workspace</h4>
                            <p class="text-xs font-medium text-slate-500 max-w-sm leading-relaxed">
                                Hidden from the public Explore directory. Only invited members can view and access this workspace. You can change this setting later.
                            </p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" id="is_private" value="1" class="sr-only peer">
                            <div class="w-14 h-8 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:start-[4px] after:bg-slate-400 after:border-slate-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 peer-checked:after:bg-white peer-checked:after:border-white"></div>
                        </label>
                    </div>

                    <div class="flex items-start gap-4 p-5 rounded-3xl bg-blue-500/5 border border-blue-500/10">
                        <div class="p-2 bg-blue-500/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-400"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <div class="text-sm text-blue-300 font-medium leading-relaxed pt-1">
                            You will automatically be assigned as the <strong class="text-white">Admin</strong> of this team. You can invite other members later.
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-6 pt-10 border-t border-slate-800/50">
                    <a href="/teams" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] px-10 py-4 rounded-full transition-all shadow-xl shadow-blue-600/20 hover:scale-105 active:scale-95">
                        Create Workspace
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
