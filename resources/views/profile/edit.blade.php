<x-layouts.app title="Edit Profile - {{ config('app.name', 'Ticket Hub') }}" sidebar="global">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-8 opacity-0 animate-[fadeIn_0.3s_ease-out_forwards]">
            <h1 class="text-3xl font-display font-medium tracking-tight text-text-primary mb-2">Edit Profile</h1>
            <p class="text-text-secondary text-[13px]">Update your personal information and profile picture.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-surface-1 border border-border rounded-[8px] p-8 opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards]">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <!-- Name Input -->
                    <div class="space-y-1.5">
                        <label for="name" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required 
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-2.5 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 text-[13px] placeholder-text-muted">
                        @error('name') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bio Input -->
                    <div class="space-y-1.5">
                        <label for="bio" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">About Me</label>
                        <textarea name="bio" id="bio" rows="5" 
                            class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-3 focus:outline-none focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder-text-muted resize-none text-[13px] leading-relaxed"
                            placeholder="Tell us a bit about yourself...">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>

                    <!-- Avatar Input -->
                    <div class="space-y-2.5">
                        <label class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Profile Picture</label>
                        
                        <div class="flex items-center gap-6 p-5 rounded-[6px] bg-surface-2 border border-border">
                            <!-- Current Preview -->
                            <div class="flex-shrink-0">
                                @if(auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" 
                                         alt="Current Avatar" 
                                         class="w-16 h-16 rounded-[6px] object-cover border border-border">
                                @else
                                    <div class="w-16 h-16 rounded-[6px] bg-surface-3 flex items-center justify-center border border-border">
                                        <span class="text-2xl font-mono font-medium text-text-secondary uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
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
                                           class="block w-full text-[13px] text-text-secondary
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-[4px] file:border-0
                                                  file:text-[11px] file:font-mono file:uppercase file:tracking-[0.08em]
                                                  file:bg-surface-3 file:text-text-primary file:cursor-pointer
                                                  hover:file:bg-border-light
                                                  cursor-pointer transition-all duration-150">
                                </label>
                                <p class="text-[10px] font-mono text-text-muted uppercase tracking-[0.08em]">JPG, PNG or GIF • Max 1MB</p>
                            </div>
                        </div>
                        @error('avatar') <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-border mt-8">
                    <a href="{{ route('users.show', auth()->user()) }}" class="text-[11px] font-mono uppercase tracking-[0.08em] text-text-secondary hover:text-text-primary transition-colors duration-150">
                        Cancel
                    </a>
                    <x-blue-button type="submit">
                        Save Changes
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
