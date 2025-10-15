<?php

declare(strict_types=1);

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

Route::prefix('tickets')->group(function () {
    Route::post('/', [TicketController::class, 'store']);
    Route::get('/statistics', [TicketController::class, 'statistics']);
});
