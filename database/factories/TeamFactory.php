<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'is_private' => fake()->boolean(),
            'is_active' => true,
            'slug' => fake()->unique()->slug(),
            'logo' => null,
            'user_id' => \App\Models\User::factory()->create()
        ];
    }
}
