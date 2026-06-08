<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'parent_id'
    ];

    public function scopeLoadRelated(Builder $commentQuery): Builder
    {
        return $commentQuery->with(['user', 'childComments'])
            ->withCount('likes')
            ->when(Auth::check(), function ($query) {
                $query->withExists(['likes' => fn($q) => $q->where('user_id', Auth::id())]);
            });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): MorphToMany
    {
        return $this->morphToMany(User::class, 'likable', 'likes');
    }

    public function chirp(): BelongsTo
    {
        return $this->belongsTo(Chirp::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


    public function childComments(): HasMany
    {
        return $this->comments()
            ->with(['user', 'childComments'])
            ->withCount('likes')
            ->when(Auth::check(), function ($query) {
                $query->withExists(['likes' => fn($q) => $q->where('user_id', Auth::id())]);
            })
            ->latest();
    }
}
