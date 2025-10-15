<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TicketController;

Route::prefix('tickets')->group(function () {
    Route::post('/', [TicketController::class, 'store']);
    Route::get('/statistics', [TicketController::class, 'statistics']);
});
