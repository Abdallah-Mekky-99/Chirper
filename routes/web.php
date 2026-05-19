<?php

use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/design-preview', function () {
    return view('preview');
})->name('design-preview');

Route::get('/', [ChirpController::class, 'index'])->name('chirps.index');

Route::middleware('auth')->group(function () {

    Route::resource('chirps', ChirpController::class)->only(['store', 'edit', 'update', 'destroy']);

    Route::resource('profile', ProfileController::class)->only(['show']);

    Route::resource('chirps.comments', CommentController::class)->only(['store', 'update', 'destroy'])->shallow();

    Route::post('/users/follow/{userToFollow}', [FollowerController::class, 'store'])->name('toggle-follow');

    Route::post('/logout', Logout::class);

    // api
    Route::post('api/likes/{type}/{id}', [LikeController::class, 'store'])->name('like.toggle');
});

// register & login
Route::middleware('guest')->group(function () {

    Route::view('/register', 'auth.register')
        ->name('register');
    Route::post('/register', Register::class);

    Route::view('/login', 'auth.login')
        ->name('login');
    Route::post('/login', Login::class);
});
