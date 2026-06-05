<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class OAuthController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $account = SocialAccount::query()->where([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ])->first();

        if ($account) {
            Auth::login($account->user);
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        $user = User::query()->firstOrCreate(
            ['email' => $socialUser->getEmail()],
            ['name' => $socialUser->getName() ?? $socialUser->getNickname()]
        );

        $user->socialAccounts()->create([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'provider_token' => $socialUser->token,
            'provider_refresh_token' => $socialUser->refreshToken
        ]);

        Auth::login($user);

        return redirect()->intended('/')->with('success', 'Welcome back!');
    }
}
