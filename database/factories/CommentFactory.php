<?php

namespace Database\Factories;

use App\Models\Chirp;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->realText(255, 5),
            'user_id' => User::factory(),
            'chirp_id' => Chirp::factory(),
            'created_at' => fake()->dateTimeBetween('-1 years'),
        ];
    }
}
