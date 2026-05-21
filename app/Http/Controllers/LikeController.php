<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $profileId)
    {
        $user = User::query()
            ->with([
                'chirpLikes.topLevelComments',
                'followers' => fn($q) => $q->withIsFollowed(),
                'followings' => fn($q) => $q->withIsFollowed()
            ])
            ->withCount(['followers', 'followings'])
            ->withIsFollowed()
            ->findOrFail($profileId);

        return view('profile', [
            'user' => $user,
            'chirps' => $user->chirpLikes,
        ]);
    }
}
