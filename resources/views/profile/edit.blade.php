<x-layouts.app title="Edit Profile - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold tracking-tight text-white mb-2">Edit Profile</h1>
            <p class="text-slate-400 text-lg">Update your personal information and profile picture.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-800 rounded-3xl shadow-xl p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PATCH')

                <div class="space-y-8">
                    <!-- Name Input -->
                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required 
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-lg placeholder:text-slate-700">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bio Input -->
                    <div class="space-y-2">
                        <label for="bio" class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">About Me</label>
                        <textarea name="bio" id="bio" rows="5" 
                            class="w-full bg-slate-950 border border-slate-800 text-white rounded-2xl px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-slate-700 resize-none font-medium leading-relaxed"
                            placeholder="Tell us a bit about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Avatar Input -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-600 uppercase tracking-widest ml-1">Profile Picture</label>
                        
                        <div class="flex items-center gap-8 p-6 rounded-3xl bg-slate-950/50 border border-slate-800/50">
                            <!-- Current Preview -->
                            <div class="flex-shrink-0">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                         alt="Current Avatar" 
                                         class="w-24 h-24 rounded-3xl object-cover border-2 border-slate-800 shadow-2xl">
                                @else
                                    <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center border-2 border-slate-800 shadow-2xl">
                                        <span class="text-3xl font-black text-slate-700 uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- File Input -->
                            <div class="flex-grow">
                                <label class="block mb-2">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input type="file" 
                                           name="avatar" 
                                           id="avatar" 
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
                        @error('avatar') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-6 pt-10 border-t border-slate-800/50">
                    <a href="{{ route('users.show', auth()->user()) }}" class="text-xs font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">
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
