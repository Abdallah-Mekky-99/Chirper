<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class LikeToggle extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $type, int $id)
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
}
