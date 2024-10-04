<?php

use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/session', [SessionController::class, 'login'])
                ->middleware('guest')
                ->name('login');

Route::put('/session', [SessionController::class, 'refreshToken'])
                ->middleware('guest')
                ->name('refresh-token');

Route::post('/logout', [SessionController::class, 'logout'])
                ->middleware('guest')
                ->name('logout');
                

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(ReminderController::class)->group(function () {
        Route::get('/reminders', 'index')->name('reminders.index');
        Route::get('/reminders/{id}', 'show')->name('reminders.show');
        Route::post('/reminders', 'store')->name('reminders.store');
        Route::put('/reminders/{id}', 'update')->name('reminders.update');
        Route::delete('/reminders/{id}', 'destroy')->name('reminders.delete');
    });
});
