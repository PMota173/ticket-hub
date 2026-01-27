<?php

use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/v1/tickets', [TicketController::class, 'index'])->name('api.tickets.index');
    Route::get('/v1/tickets/{ticket}', [TicketController::class, 'show'])->name('api.tickets.show');
    Route::post('/v1/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
    Route::patch('/v1/tickets/{ticket}', [TicketController::class, 'update'])->name('api.tickets.update');

    Route::get('/v1/team/members', [TeamController::class, 'members'])->name('api.team.members');
});
