<?php

use App\Http\Controllers\Api\LikeToggle;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/design-preview', function () {
    return view('preview');
})->name('design-preview')
    ->middleware('auth.basic');

Route::get('/', [ChirpController::class, 'index'])->name('chirps.index');

Route::middleware('auth')->group(function () {

    Route::resource('chirps', ChirpController::class)->only(['store', 'edit', 'update', 'destroy']);

    Route::resource('profile', ProfileController::class)->only(['show']);

    Route::resource('chirps.comments', CommentController::class)->only(['store', 'update', 'destroy'])->shallow();

    Route::post('/users/follow/{userToFollow}', [FollowerController::class, 'store'])->name('toggle-follow');

    Route::post('/logout', Logout::class);

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


    //Google
    Route::get('/auth/google/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name('google-auth');

    Route::get('/auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->user();

        $user = User::query()->updateOrCreate(
            [
                'google_id' => $googleUser->id,
            ],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]
        );

        Auth::login($user);

        return redirect('/');
    });
});
