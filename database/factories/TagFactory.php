<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Bug', 'Feature', 'Enhancement', 'Critical', 'Low Priority',
                'Documentation', 'UI/UX', 'Backend', 'Frontend', 'Database',
                'Security', 'Performance', 'Refactor', 'Testing', 'Deployment',
                'Hotfix', 'Research', 'Question', 'WontFix', 'Duplicate'
            ]),
        ];
    }
}
