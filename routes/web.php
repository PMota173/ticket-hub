<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamInvitationController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TicketTagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::delete('/logout', [SessionController::class, 'destroy']);

    // teams routes
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');

    // Team Scoped Routes
    Route::prefix('/teams/{team:slug}')->group(function () {
        Route::get('/', [TeamController::class, 'show'])->name('teams.show');

        // tickets routes
        Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
        Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
        Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
        Route::patch('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');
        Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');

        // tickets-tag routes
        Route::post('/tickets/{ticket}/tags', [TicketTagController::class, 'store'])->name('tickets.tags.store');
        Route::delete('/tickets/{ticket}/tags/{tag}', [TicketTagController::class, 'destroy'])->name('tickets.tags.destroy');

        // tickets-comment routes
        Route::post('/tickets/{ticket}/comments', [TicketCommentController::class, 'store'])->name('tickets.comments.store');
        Route::delete('/tickets/{ticket}/comments/{comment}', [TicketCommentController::class, 'destroy'])->name('tickets.comments.destroy');

        // team members routes
        Route::get('/members', [TeamMemberController::class, 'index'])->name('members.index');
        Route::get('/members/{member}', [TeamMemberController::class, 'show'])->name('members.show');
        Route::post('/members', [TeamMemberController::class, 'store'])->name('members.store');

        Route::get('/members/{member}/edit', [TeamMemberController::class, 'edit'])->name('members.edit');

        Route::put('/members/{member}', [TeamMemberController::class, 'update'])->name('members.update');
        Route::patch('/members/{member}', [TeamMemberController::class, 'update'])->name('members.update');

        Route::delete('/members/{member}', [TeamMemberController::class, 'destroy'])->name('members.destroy');

        // team invitation routes
        Route::get('/invitations', [TeamInvitationController::class, 'index'])->name('invitations.index');
        Route::get('/invitations/{invitation}', [TeamInvitationController::class, 'show'])->name('invitations.show');
        Route::get('invitations/create', [TeamInvitationController::class, 'create'])->name('invitations.create');

        Route::post('invitations', [TeamInvitationController::class, 'store'])->name('invitations.store');
        Route::delete('invitations/{invitation}', [TeamInvitationController::class, 'destroy'])->name('invitations.destroy');
    });
});

// public invitation link
Route::get('/invitations/{token}', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
