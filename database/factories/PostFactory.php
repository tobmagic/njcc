<?php

namespace Database\Factories;

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
    $title = $this->faker->sentence();
    return [
        'title'        => $title,
        'slug'         => \Illuminate\Support\Str::slug($title),
        'content'      => $this->faker->paragraphs(3, true),
        'published_at' => now(),
        'user_id'      => \App\Models\User::factory(), // This creates a user if one isn't provided
    ];
}
}
