<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the Main User (Admin)
        $mainUser = User::factory()->create([
            'name' => 'Pedro Mota',
            'email' => 'pvmota012@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 2. Create other users
        $users = User::factory(20)->create();

        // 3. Create specific realistic teams
        $teams = collect([
            ['name' => 'Engineering', 'description' => 'Core product development and maintenance.'],
            ['name' => 'Customer Support', 'description' => 'Handling client tickets and inquiries.'],
            ['name' => 'Design', 'description' => 'UI/UX design and creative assets.'],
            ['name' => 'DevOps', 'description' => 'Infrastructure, CI/CD, and deployment.'],
        ])->map(function ($teamData) use ($mainUser) {
            return Team::factory()->create([
                'name' => $teamData['name'],
                'description' => $teamData['description'],
                'user_id' => $mainUser->id, // Main user owns these teams
                'slug' => \Str::slug($teamData['name']),
            ]);
        });

        // 4. Populate Teams with Members and Tickets
        foreach ($teams as $team) {
            // Add Main User as Admin
            $team->users()->attach($mainUser->id, ['is_admin' => true]);

            // Add random members
            $teamMembers = $users->random(rand(5, 10));
            foreach ($teamMembers as $member) {
                if (!$team->users()->where('user_id', $member->id)->exists()) {
                    $team->users()->attach($member->id, ['is_admin' => fake()->boolean(20)]);
                }
            }

            // Create Tags for the team
            $tags = Tag::factory(5)->create(['team_id' => $team->id]);

            // Create Tickets
            Ticket::factory(rand(10, 20))->create([
                'team_id' => $team->id,
                'author_id' => $team->users->random()->id,
                'author_type' => User::class,
                'assigned_id' => fake()->boolean(70) ? $team->users->random()->id : null, // 70% chance of assignment
            ])->each(function ($ticket) use ($team, $users, $tags, $mainUser) {
                // Attach random tags
                $ticket->tags()->attach($tags->random(rand(1, 3)));

                // Add comments
                Comment::factory(rand(0, 5))->create([
                    'ticket_id' => $ticket->id,
                    'author_id' => $users->random()->id,
                    'author_type' => User::class,
                ]);
            });
        }

        // 5. Ensure Main User has some assigned tickets across teams
        $allTickets = Ticket::all();
        $ticketsToAssign = $allTickets->random(min(5, $allTickets->count()));
        foreach ($ticketsToAssign as $ticket) {
            $ticket->update(['assigned_id' => $mainUser->id]);
        }
    }
}
