<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
    Route::post('/logout', Logout::class);
});


// register & login
Route::middleware('guest')->group(function() {

    Route::view('/register', 'auth.register')
        ->name('register');
    Route::post('/register', Register::class);

    Route::view('/login', 'auth.login')
        ->name('login');
    Route::post('/login', Login::class);
});



Route::get('/quotes', [QuoteController::class, 'index']);
Route::post('/Add-quote', [QuoteController::class, 'store']);