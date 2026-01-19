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
        $teamName = fake()->unique()->randomElement([
            'Customer Support',
            'Engineering',
            'Sales',
            'Marketing',
            'Human Resources',
            'IT Operations',
            'Product Management',
            'Design',
            'QA Testing',
            'DevOps',
            'Finance',
            'Legal',
        ]);

        return [
            'name' => $teamName,
            'description' => fake()->randomElement([
                'Responsible for handling all customer inquiries and support tickets.',
                'Building the core product and features.',
                'Driving revenue and customer acquisition.',
                'Promoting the brand and products.',
                'Managing employee relations and benefits.',
                'Maintaining internal systems and infrastructure.',
                'Defining product strategy and roadmap.',
                'Creating user experiences and visual designs.',
                'Ensuring quality and stability of releases.',
                'Managing deployment pipelines and cloud infrastructure.',
            ]),
            'is_private' => fake()->boolean(20), // 20% chance of being private
            'is_active' => true,
            'logo' => null,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
