@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Workspaces & Members</h1>
    
    <p class="text-base text-text-secondary opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] mb-8 leading-relaxed">
        Workspaces are the heart of Ticket Hub. A workspace owns tickets, members, and robots.
    </p>

    <!-- WORKSPACE CREATION -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_50ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">01.</span>
            Workspace Creation
        </h2>
        <div class="prose prose-sm prose-invert max-w-none text-text-secondary">
            <p>Every workspace is an isolated environment. When you create a workspace, you become its primary administrator.</p>
            <ul class="space-y-4 my-6">
                <li class="flex items-start gap-3">
                    <div class="w-1.5 h-1.5 rounded-none bg-accent mt-2 flex-shrink-0"></div>
                    <span><strong class="text-text-primary">Identity:</strong> The name and description are visible on the portal when the workspace is public. Logos accept <code>jpg</code>, <code>jpeg</code>, or <code>png</code> up to 2MB.</span>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-1.5 h-1.5 rounded-none bg-accent mt-2 flex-shrink-0"></div>
                    <span><strong class="text-text-primary">Privacy:</strong> Public workspaces appear in the Explore portal and allow logged-in users to submit tickets. Private workspaces are invite-only and hidden from the portal.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- ROLES & PERMISSIONS -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_100ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">02.</span>
            Roles & Permissions
        </h2>
        <div class="overflow-x-auto border border-border bg-surface-1 mb-6">
            <table class="w-full text-left text-[13px]">
                <thead class="bg-surface-2 border-b border-border text-[10px] font-mono uppercase tracking-widest text-text-muted">
                    <tr>
                        <th class="px-6 py-4 font-normal">Action</th>
                        <th class="px-6 py-4 font-normal text-center">Workspace Admin</th>
                        <th class="px-6 py-4 font-normal text-center">Member</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    <tr class="hover:bg-surface-1 transition-colors">
                        <td class="px-6 py-4 font-display font-medium text-text-primary">View Kanban Board</td>
                        <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded-none">Allowed</span></td>
                        <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded-none">Allowed</span></td>
                    </tr>
                    <tr class="hover:bg-surface-1 transition-colors">
                        <td class="px-6 py-4 font-display font-medium text-text-primary">Update Workspace Settings</td>
                        <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded-none">Allowed</span></td>
                        <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded-none">Forbidden</span></td>
                    </tr>
                    <tr class="hover:bg-surface-1 transition-colors">
                        <td class="px-6 py-4 font-display font-medium text-text-primary">Manage Members</td>
                        <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded-none">Allowed</span></td>
                        <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded-none">Forbidden</span></td>
                    </tr>
                    <tr class="hover:bg-surface-1 transition-colors">
                        <td class="px-6 py-4 font-display font-medium text-text-primary">Create Robots</td>
                        <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded-none">Allowed</span></td>
                        <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded-none">Forbidden</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- WORKSPACE TYPES -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_150ms_forwards] mb-16">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">03.</span>
            Workspace Types
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-surface-1 border border-border">
                <h3 class="font-display font-medium text-text-primary mb-2">Public Workspace</h3>
                <p class="text-text-secondary text-[13px] leading-relaxed">
                    Listed on the <strong>Explore</strong> page when active. Logged-in users can submit tickets via the Portal, but the internal Kanban stays private to workspace members.
                </p>
            </div>
            <div class="p-6 bg-surface-1 border border-border">
                <h3 class="font-display font-medium text-text-primary mb-2">Private Workspace</h3>
                <p class="text-text-secondary text-[13px] leading-relaxed">
                    Completely hidden from the portal. Only existing members can see or interact with it. Invitations are required for anyone else to join.
                </p>
            </div>
        </div>
    </section>

    <!-- INVITATIONS -->
    <section class="opacity-0 animate-[fadeIn_0.3s_ease-out_200ms_forwards] mb-8">
        <h2 class="text-xl font-display font-medium text-text-primary mb-4 flex items-center gap-2">
            <span class="text-accent font-mono text-sm">04.</span>
            Invitations
        </h2>
        <div class="bg-surface-3 border-l-2 border-accent p-6">
            <p class="text-text-secondary text-[13px] leading-relaxed mb-4">
                Invitations are secure, single-use tokens sent via email.
            </p>
            <ul class="space-y-3">
                <li class="flex items-center gap-3 text-[12px] text-text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-accent"><path d="M20 6 9 17l-5-5"/></svg>
                    Only workspace admins can generate invitations from the Members area.
                </li>
                <li class="flex items-center gap-3 text-[12px] text-text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-accent"><path d="M20 6 9 17l-5-5"/></svg>
                    Recipients can accept invitations even if they don't have an account yet.
                </li>
            </ul>
        </div>
    </section>
@endsection

@section('pagination')
    <a href="{{ route('guides.index') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
        Back: Documentation
    </a>
    <a href="{{ route('guides.show', 'tickets') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Tickets & Kanban
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
