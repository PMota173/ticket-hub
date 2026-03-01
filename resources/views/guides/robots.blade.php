@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Robots & Tokens</h1>
    
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        Robots are API agents scoped to a single workspace. Use them to create and update tickets from external systems.
    </p>

    <!-- LIMITS -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] mb-16">
        <h3 class="font-medium text-text-primary mb-2">🤖 Limit: 3 Robots per Workspace</h3>
        <p class="text-text-secondary text-[13px] leading-relaxed">
            Each workspace can have up to 3 robots. Delete an existing robot to free a slot.
        </p>
    </section>

    <!-- AUTHENTICATION -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">01.</span>
            Authentication
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <div class="space-y-6">
                <div class="p-6 bg-surface-1 border border-border">
                    <h4 class="text-text-primary font-medium mb-2">Generating Tokens</h4>
                    <p class="text-[13px] leading-relaxed">
                        Only <strong>Workspace Admins</strong> can create robots. Go to <code>Workspace Settings > Robots</code> and create a new integration.
                    </p>
                </div>
                <div class="p-6 bg-surface-1 border border-border">
                    <h4 class="text-text-primary font-medium mb-2">Token Security</h4>
                    <p class="text-[13px] leading-relaxed">
                        Tokens are displayed only once. If you lose a token, you must delete the robot and create a new one to generate a new key.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- USAGE -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards] mb-8">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">02.</span>
            API Usage
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>Use the robot token as a <code>Bearer</code> token in the <code>Authorization</code> header when calling the API. Each token is tied to the robot's workspace.</p>
        </div>
    </section>
@endsection

@section('pagination')
    <a href="{{ route('guides.show', 'portal') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Previous: Public Portal
    </a>
    <a href="{{ route('guides.show', 'api-reference') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: API Reference
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
