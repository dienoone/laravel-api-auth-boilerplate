<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->controller(AuthController::class)
    ->name('auth.')
    ->group(function () {

        // public routes
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::post('/logout', 'logout')->name('logout');
                Route::get('/me', 'me')->name('user');
            });
    });
