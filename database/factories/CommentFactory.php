<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
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
            'body' => fake()->randomElement([
                'I am looking into this now.',
                'Can you provide more details?',
                'This should be fixed in the next release.',
                'I have reproduced the issue.',
                'Please check the logs attached.',
                'Is this urgent?',
                'I will escalate this to the engineering team.',
                'Fixed in commit #a1b2c3d.',
                'Customer is asking for an update.',
                'Deployment failed again.',
            ]) . ' ' . fake()->sentence(),
            'author_id' => User::factory(),
            'author_type' => User::class,
            'ticket_id' => \App\Models\Ticket::factory(),
        ];
    }
}