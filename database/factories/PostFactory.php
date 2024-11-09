<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $titleCount = 1;
        $title = 'Post title ' . $titleCount++;
        return [
            'title' => $title,
            'author_id' => User::inRandomOrder()->first()->id,
            'slug' =>  Str::slug($title),
            'content' => fake()->text(),
            'status' => fake()->randomElement(['Active', 'Draft', 'Scheduled']),
        ];
    }
}
