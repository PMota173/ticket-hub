<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => 'auth:sanctum'], function () {

//    Route::get('/v1/tickets', [App\Http\Controllers\Api\TicketController::class, 'index'])->name('api.tickets.index');
//
//    Route::get('/v1/tickets/{ticket}', [App\Http\Controllers\Api\TicketController::class, 'show'])->name('api.tickets.show');
//
    Route::post('/v1/tickets', [App\Http\Controllers\Api\TicketController::class, 'store'])->name('api.tickets.store');
//
//    Route::patch('/v1/tickets/{ticket}', [App\Http\Controllers\Api\TicketController::class, 'update'])->name('api.tickets.update');
//
//    Route::delete('/v1/tickets/{ticket}', [App\Http\Controllers\Api\TicketController::class, 'destroy'])->name('api.tickets.destroy');
});
