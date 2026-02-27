@extends('layouts.docs')

@section('content')
    <h1 class="opacity-0 animate-[fadeIn_0.3s_ease-out_forwards] text-3xl font-display font-medium text-text-primary mb-6">Teams & Members</h1>
    
    <p class="text-text-secondary text-base mb-8 leading-relaxed">
        Teams are the heart of Ticket Hub. A team is a workspace that owns tickets, members, and robots.
    </p>

    <!-- WORKSPACE BASICS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Workspace Basics
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Name, Description, Logo</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                The name and description are visible on the portal when the team is public. Logos accept <code>jpg</code>, <code>jpeg</code>, or <code>png</code> up to 2MB.
            </p>
        </div>
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <h3 class="font-medium text-text-primary mb-2">Private vs Public</h3>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Public teams appear in the Explore portal and allow logged-in users to submit tickets. Private teams are invite-only and hidden from the portal.
            </p>
        </div>
    </div>

    <!-- ROLES SECTION -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Roles & Permissions
    </h2>
    <p class="text-text-secondary mb-6">
        Ticket Hub uses two roles: Admin and Member. Portal visitors are handled separately in the Public Portal guide.
    </p>
    
    <div class="overflow-hidden rounded-[8px] border border-border mb-8 shadow-lg">
        <table class="w-full text-left text-[13px] text-text-secondary">
            <thead class="bg-surface-2 text-text-primary uppercase tracking-[0.08em] font-bold text-xs">
                <tr>
                    <th class="px-6 py-4">Action</th>
                    <th class="px-6 py-4 text-center">Team Admin</th>
                    <th class="px-6 py-4 text-center">Member</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border bg-bg/50">
                <tr class="hover:bg-surface-1 transition-colors">
                    <td class="px-6 py-4 font-display font-medium text-text-primary">Create Tickets</td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                </tr>
                <tr class="hover:bg-surface-1 transition-colors">
                    <td class="px-6 py-4 font-display font-medium text-text-primary">View Kanban Board</td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                </tr>
                <tr class="hover:bg-surface-1 transition-colors">
                    <td class="px-6 py-4 font-display font-medium text-text-primary">Update Team Settings</td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                    <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded">Forbidden</span></td>
                </tr>
                <tr class="hover:bg-surface-1 transition-colors">
                    <td class="px-6 py-4 font-display font-medium text-text-primary">Manage Members</td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                    <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded">Forbidden</span></td>
                </tr>
                <tr class="hover:bg-surface-1 transition-colors">
                    <td class="px-6 py-4 font-display font-medium text-text-primary">Manage Robots</td>
                    <td class="px-6 py-4 text-center text-success"><span class="bg-success/10 px-2 py-1 rounded">Allowed</span></td>
                    <td class="px-6 py-4 text-center text-danger"><span class="bg-red-500/10 px-2 py-1 rounded">Forbidden</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PRIVACY SECTION -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Workspace Privacy
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-secondary"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                <h3 class="font-display font-medium text-text-primary">Public Team</h3>
            </div>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Listed on the <strong>Explore</strong> page when active. Logged-in users can submit tickets via the Portal, but the internal Kanban stays private to team members.
            </p>
        </div>
        <div class="bg-surface-2 p-6 rounded-[8px] border border-border">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7c.44 0 .87-.03 1.28-.09"/><path d="m2 2 20 20"/></svg>
                <h3 class="font-display font-medium text-text-primary">Private Team</h3>
            </div>
            <p class="text-text-secondary text-[13px] leading-relaxed">
                Hidden from the Explore directory and inaccessible to portal visitors. Members join only via email invitations.
            </p>
        </div>
    </div>

    <!-- INVITATIONS -->
    <h2 class="text-2xl font-display font-medium text-text-primary mb-4 mt-12 flex items-center gap-3">
        <span class="w-8 h-1 bg-accent rounded-full"></span>
        Invitations
    </h2>
    <ul class="space-y-4 mb-8">
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Admin Only</strong>
                <p class="text-text-secondary text-[13px]">Only team admins can generate invitations from the Members area.</p>
            </div>
        </li>
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Email Validation</strong>
                <p class="text-text-secondary text-[13px]">Invitations are tied to a specific email. The user must log in or register with that exact email to accept.</p>
            </div>
        </li>
        <li class="flex gap-4 items-start">
            <div class="bg-surface-3 p-2 rounded-[6px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-text-primary"><path d="M3 12h18"/><path d="M12 3v18"/></svg>
            </div>
            <div>
                <strong class="text-text-primary block mb-1">Accept Flow</strong>
                <p class="text-text-secondary text-[13px]">The invite link routes the user to login or registration, then returns to the invitation flow.</p>
            </div>
        </li>
    </ul>
@endsection

@section('pagination')
    <a href="{{ route('guides.index') }}" class="flex items-center gap-2 text-[13px] font-medium text-text-muted hover:text-accent transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="rotate-180"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        Back to Intro
    </a>
    <a href="{{ route('guides.show', 'tickets') }}" class="flex items-center gap-2 text-[13px] font-medium text-accent hover:text-accent transition-colors">
        Next: Tickets & Kanban
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
    </a>
@endsection
