<?php

namespace Database\Seeders;

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
        // Create a test user
        $pedro = User::factory()->create([
            'name' => 'Pedro Mota',
            'email' => 'pvmota012@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Create some other users
        $users = User::factory(10)->create();

        // Create Teams
        $team1 = Team::factory()->create([
            'name' => 'Pedro Soft',
            'slug' => 'pedro-soft',
            'user_id' => $pedro->id,
        ]);

        $team2 = Team::factory()->create([
            'name' => 'Acme Corp',
            'slug' => 'acme-corp',
            'user_id' => $users->random()->id,
        ]);

        // Attach Pedro to teams
        $pedro->teams()->attach($team1->id, ['is_admin' => true]);
        $pedro->teams()->attach($team2->id, ['is_admin' => false]);

        // Attach some other users to teams
        foreach ($users as $user) {
            $user->teams()->attach(
                fake()->randomElement([$team1->id, $team2->id]),
                ['is_admin' => fake()->boolean()]
            );
        }

        // Create Tickets for Team 1
        Ticket::factory(15)->create([
            'team_id' => $team1->id,
            'user_id' => fn() => User::all()->random()->id,
        ]);

        // Create Tickets for Team 2
        Ticket::factory(10)->create([
            'team_id' => $team2->id,
            'user_id' => fn() => User::all()->random()->id,
        ]);

        // Create some extra random teams and tickets
        Team::factory(3)->create()->each(function ($team) {
            Ticket::factory(5)->create([
                'team_id' => $team->id,
                'user_id' => User::all()->random()->id,
            ]);
        });
    }
}