<x-layouts.app title="Edit Profile - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">Edit Profile</h1>
            <p class="text-slate-400 mt-2">Update your personal information and profile picture.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900/50 border border-slate-700 rounded-xl shadow-sm p-8">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <!-- Name Input -->
                    <x-form-input name="name" label="Full Name" :value="auth()->user()->name" placeholder="Your full name" required />

                    <!-- Bio Input -->
                    <div class="space-y-2">
                        <label for="bio" class="text-sm font-medium text-slate-300">Bio</label>
                        <textarea
                            name="bio"
                            id="bio"
                            rows="5"
                            class="w-full bg-slate-950/50 border border-slate-700 text-white rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 placeholder:text-slate-500 resize-none"
                            placeholder="Tell us a bit about yourself..."
                        >{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Avatar Input -->
                    <div class="space-y-4">
                        <label class="text-sm font-medium text-slate-300">Profile Picture</label>
                        
                        <div class="flex items-center gap-6 p-4 rounded-xl bg-slate-950/30 border border-slate-700/50">
                            <!-- Current Preview -->
                            <div class="flex-shrink-0">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                         alt="Current Avatar" 
                                         class="w-20 h-20 rounded-2xl object-cover border-2 border-slate-700 shadow-xl">
                                @else
                                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center border-2 border-slate-700 shadow-xl">
                                        <span class="text-2xl font-black text-slate-600 uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- File Input -->
                            <div class="flex-grow">
                                <input type="file" 
                                       name="avatar" 
                                       id="avatar" 
                                       accept="image/*"
                                       class="block w-full text-sm text-slate-400
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:text-xs file:font-bold file:uppercase file:tracking-wider
                                              file:bg-blue-600 file:text-white
                                              hover:file:bg-blue-500
                                              cursor-pointer transition-all">
                                <p class="mt-2 text-[10px] font-bold text-slate-500 uppercase tracking-tight">JPG, PNG or GIF • Max 1MB</p>
                            </div>
                        </div>
                        @error('avatar')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-800">
                    <a href="{{ route('users.show', auth()->user()) }}" class="px-5 py-2.5 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                        Cancel
                    </a>
                    <x-blue-button type="submit" class="px-8">
                        Save Changes
                    </x-blue-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>