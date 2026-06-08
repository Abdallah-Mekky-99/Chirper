<?php

namespace Database\Seeders;

use App\Models\Chirp;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)
            ->has(Chirp::factory(2))
            ->create();

        $chirps = Chirp::all();

        $users->each(function (User $user) use ($chirps) {
            $user->chirpLikes()->attach(
                $chirps->random(2)
            );
        });

        Comment::factory(20)
            ->recycle($users)
            ->recycle($chirps)
            ->create();
    }
}
