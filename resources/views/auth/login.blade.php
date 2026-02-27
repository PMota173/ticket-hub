<x-layouts.auth title="Log In - Ticket Hub">
    <div class="bg-surface-1 border border-border rounded-[8px] p-8 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)]">
        <div class="mb-8 text-center">
            <h2 class="text-xl font-display font-medium text-text-primary tracking-tight">Welcome back</h2>
            <p class="text-[13px] text-text-secondary mt-1">Enter your credentials to access your workspace.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label for="email" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="name@company.com">
                @error('email')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-[11px] font-mono text-text-muted uppercase tracking-[0.08em]">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-mono text-accent hover:text-accent-hover transition-colors">Forgot?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full bg-surface-2 border border-border text-text-primary rounded-[6px] px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-accent focus:shadow-[0_0_0_3px_var(--color-accent-glow)] transition-all duration-150 placeholder:text-text-muted text-[13px]"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-danger font-mono text-[11px] mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center py-1">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded-[4px] bg-surface-3 border-border text-accent focus:ring-accent focus:ring-offset-bg">
                <label for="remember_me" class="ml-2 text-[12px] text-text-secondary">Keep me signed in</label>
            </div>

            <x-blue-button type="submit" class="w-full py-3">
                Sign In
            </x-blue-button>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-[13px] text-text-secondary">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-accent hover:text-accent-hover transition-colors">Create free account</a>
        </p>
    </div>
</x-layouts.auth>
