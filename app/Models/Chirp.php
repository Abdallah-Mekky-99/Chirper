<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable', 'likes', 'likable_id', 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function topLevelComments(): HasMany
    {
        return $this->comments()
            ->whereNull('parent_id')
            ->with(['user', 'childComments'])
            ->withCount('likes')
            ->when(Auth::check(), function ($query) {
                $query->withExists(['likes' => fn($q) => $q->where('user_id', Auth::id())]);
            })
            ->latest();
    }
}
