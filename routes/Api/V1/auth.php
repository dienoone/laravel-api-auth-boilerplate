<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {

        // public routes
        Route::post('/register',                'register');
        Route::post('/login',                   'login');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('verification.verify');

        // Protected routes
        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::post('/logout',          'logout');
                Route::get('/me',               'me');
                Route::post('/email/resend',    'resendVerification');
            });
    });
