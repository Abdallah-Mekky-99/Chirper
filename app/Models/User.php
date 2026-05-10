<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class)
            ->chaperone()
            ->withCount('likes', 'comments')
            ->withExists(['likes' => fn($q) => $q->where('user_id', Auth::id())]);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Chirp::class, 'likes');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function scopeWithIsFollowed($query) {
        return $query->when(Auth::check(), fn($q) =>
            $q->withExists([
                'followers as is_followed' => fn ($f) => $f->where('followers.follower_id', Auth::id()),
            ])
        );
    }

    public function IsFollowed(): Attribute {
        return Attribute::make(
            get: fn($value) => (bool) ($value ?? false)
        );
    }
}
