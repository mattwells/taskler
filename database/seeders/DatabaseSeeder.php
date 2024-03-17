<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = User::factory()->count(5)->create();

        $users->add(User::factory()->create([
            'name' => 'Matt',
            'email' => 'matt@example.com',
            'password' => 'password',
            'permissions' => 'admin',
        ]));

        Task::factory()->count(20)->create([
            'author_id' => fake()->randomElement($users)->id,
            'assigned_id' => fake()->optional()->randomElement($users)?->id,
        ]);
    }
}
