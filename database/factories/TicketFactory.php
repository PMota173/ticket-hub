<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $issues = [
            'Login failed' => 'User cannot log in with correct credentials.',
            'Payment gateway error' => 'Transactions are failing with error 500.',
            'Broken image on homepage' => 'The hero image is not loading on Safari.',
            'Email notifications not sending' => 'Users are not receiving password reset emails.',
            'Slow dashboard performance' => 'The analytics dashboard takes 10+ seconds to load.',
            'Typo in terms of service' => 'Found a spelling mistake in section 3.2.',
            'Feature request: Dark mode' => 'Please add dark mode support.',
            'API rate limit exceeded' => 'We are hitting the rate limit too often.',
            'Database connection timeout' => 'Intermittent connection drops to the DB.',
            'User profile update failed' => 'Cannot save changes to user profile.',
            'Export to CSV broken' => 'Clicking export results in an empty file.',
            'Mobile app crash on startup' => 'Crash logs indicate a null pointer exception.',
            'Integration with Slack failed' => 'Webhook is returning 404.',
            'Search results are irrelevant' => 'Search algorithm needs tuning.',
            'Upgrade server infrastructure' => 'Need to scale up for Black Friday.',
        ];

        $title = fake()->randomElement(array_keys($issues));

        return [
            'title' => $title,
            'description' => $issues[$title] . "\n\n" . fake()->paragraph(),
            'status' => fake()->randomElement(['open', 'open', 'in_progress', 'waiting', 'closed']), // Weighted towards open
            'priority' => fake()->randomElement(['low', 'medium', 'medium', 'high']),
            'author_id' => User::factory(),
            'author_type' => User::class,
            'team_id' => Team::factory(),
        ];
    }
}
