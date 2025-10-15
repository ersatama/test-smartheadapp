<?php

use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/widget', [WidgetController::class, 'index'])->name('widget.index');

Route::prefix('admin')
    //->middleware(['auth', 'role:manager|admin'])
    ->group(function () {
        Route::get('tickets', [AdminTicketController::class, 'index'])
            ->name('admin.tickets.index');
        Route::get('tickets/{id}', [AdminTicketController::class, 'show'])
            ->name('admin.tickets.show');
    });