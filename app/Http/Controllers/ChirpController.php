<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChirpController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var Chirp[] $chirps */
        $chirps = Chirp::query()
            ->with('user')
            ->withCount('likes')
            ->when(Auth::check(), function ($query) {
                $query->withExists(['likes' => function ($query) {
                    $query->where('user_id', Auth::getUser()->id);
                }]);
            })
            ->latest()
            ->take(50)
            ->get();

        return view('home', compact('chirps'));
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
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', compact(['chirp']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Chirp Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return back()->with('success', 'Chirp Deleted!');
    }
}
