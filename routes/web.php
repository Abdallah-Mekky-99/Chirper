<?php

use App\Http\Controllers\Api\LikeToggle;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/design-preview', function () {
    return view('preview');
})->name('design-preview')
    ->middleware('auth.basic');

Route::get('/', [ChirpController::class, 'index'])->name('chirps.index');

Route::middleware('auth')->group(function () {

    // Email Verification
    Route::view('/email/verify', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])
        ->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [VerifyEmailController::class, 'resendEmail'])
        ->middleware('throttle:6,1')->name('verification.send');


    // verified users area
    Route::middleware('verified')->group(function () {

        Route::resource('chirps', ChirpController::class)->only(['store', 'edit', 'update', 'destroy']);

        Route::resource('chirps.comments', CommentController::class)->only(['store', 'update', 'destroy'])->shallow();

        Route::post('/users/follow/{userToFollow}', [FollowerController::class, 'store'])->name('toggle-follow');
    });

    // logout
    Route::post('/logout', Logout::class);


    // profile views
    Route::resource('profile', ProfileController::class)->only(['show']);

    Route::resource('profile.likes', LikeController::class)->shallow()->only('index');


    // api
    Route::post('api/likes/{type}/{id}', LikeToggle::class)->name('like.toggle');
});

// register & login
Route::middleware('guest')->group(function () {

    //register
    Route::view('/register', 'auth.register')
        ->name('register');

    Route::post('/register', Register::class);


    //login
    Route::view('/login', 'auth.login')
        ->name('login');

    Route::post('/login', Login::class);


    //OAuth2
    Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect'])->name('external-auth');

    Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback']);
});
