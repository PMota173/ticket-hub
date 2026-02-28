<x-layouts.auth title="Create Account - Ticket Hub">
    <div class="bg-surface-1 border border-border rounded-none p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
        <div class="mb-8 text-center">
            <h2 class="text-xl font-display font-medium text-text-primary tracking-tight">Create your account</h2>
            <p class="text-[13px] text-text-secondary mt-1">Join teams delivering high-precision support.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <label for="name" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="John Doe">
                @error('name')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="name@company.com">
                @error('email')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-none px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="••••••••">
                @error('password_confirmation')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <x-blue-button type="submit" class="w-full py-3">
                Get Started
            </x-blue-button>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-[13px] text-text-secondary">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-accent hover:text-accent-hover transition-colors">Sign in</a>
        </p>
    </div>
</x-layouts.auth>
