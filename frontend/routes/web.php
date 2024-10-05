<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReminderController;

Route::get('/', function () {
    return view('signin');
});


Route::middleware('checkSession')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/session', [LoginController::class, 'login'])
                ->middleware('guest')
                ->name('login');

Route::get('/session', [LoginController::class, 'show'])
                ->middleware('guest')
                ->name('show-login');

Route::put('/session', [LoginController::class, 'refreshToken'])
                ->middleware('checkSession')
                ->name('refresh-token');

Route::post('/logout', [LoginController::class, 'logout'])
                ->middleware('guest')
                ->name('logout');
                

Route::middleware('checkSession')->group(function () {
    Route::controller(ReminderController::class)->group(function () {
        Route::get('/reminders', 'index')->name('reminders.index');
        Route::get('/reminders/create', 'create')->name('reminders.create');
        Route::get('/reminders/{id}', 'show')->name('reminders.show');
        Route::post('/reminders', 'store')->name('reminders.store');
        Route::get('/reminders/edit/{id}', 'edit')->name('reminders.edit');
        Route::put('/reminders/{id}', 'update')->name('reminders.update');
        Route::delete('/reminders/{id}', 'destroy')->name('reminders.delete');
    });
});