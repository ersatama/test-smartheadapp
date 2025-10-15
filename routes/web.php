<?php

use App\Http\Controllers\WidgetController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/widget', [WidgetController::class, 'index'])->name('widget.index');

Route::prefix('admin')
    ->middleware(['auth', 'role:manager|admin'])
    ->group(function () {
        Route::get('tickets', [AdminTicketController::class, 'index'])
            ->name('admin.tickets.index');
        Route::get('tickets/{id}', [AdminTicketController::class, 'show'])
            ->name('admin.tickets.show');
        Route::patch('tickets/{id}/status', [AdminTicketController::class, 'updateStatus'])
            ->name('admin.tickets.updateStatus');
    });

Route::get('/', fn() => response('OK', 200));
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('/admin/tickets');
    }
    return back()->withErrors(['email' => 'Неверный логин или пароль']);
});
Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');