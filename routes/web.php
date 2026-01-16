<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware('auth')->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/tickets/create', [TicketsController::class, 'create']);

    Route::post('/tickets', [TicketsController::class, 'store']);
    Route::get('/tickets', [TicketsController::class, 'index']);

    Route::get('/tickets/{ticket}', [TicketsController::class, 'show']);
    Route::patch('/tickets/{ticket}', [TicketsController::class, 'update']);
});
