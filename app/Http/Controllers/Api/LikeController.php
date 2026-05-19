<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $type, int $id)
    {
        $model = match ($type) {
            'chirp' => Chirp::findOrFail($id),
            'comment' => Comment::findOrFail($id),
            default => abort(404),
        };

        $result = $model->likes()->toggle(Auth::id());

        if (count($result['attached']) == 1 || count($result['detached']) == 1) {
            $likes_count = $model->likes()->count();

            return response()->json(['likes_count' => $likes_count]);
        }

        return response()->json(status: 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
