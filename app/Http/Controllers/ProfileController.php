<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $profileId)
    {
        $user = User::query()
            ->with([
                'chirps.topLevelComments',
                'followers' => fn($q) => $q->withIsFollowed(),
                'followings' => fn($q) => $q->withIsFollowed()
            ])
            ->withCount(['followers', 'followings'])
            ->withIsFollowed()
            ->findOrFail($profileId);

        return view('profile', [
            'user' => $user,
            'chirps' => $user->chirps,
            'emptyMessage' => "This user hasn't chirped anything yet...",
            'showFollowButton' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
