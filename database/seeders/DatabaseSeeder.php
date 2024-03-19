<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unsetEventDispatcher();

        $users = User::factory(5)->create();

        $users->add(User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'permissions' => 'admin',
        ]));
        $users->add(User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => 'password',
            'permissions' => 'editor',
        ]));
        $users->add(User::factory()->create([
            'name' => 'Viewer',
            'email' => 'viewer@example.com',
            'password' => 'password',
            'permissions' => 'viewer',
        ]));
        $users->add($selfUser = User::factory()->create([
            'name' => 'Self',
            'email' => 'self@example.com',
            'password' => 'password',
            'permissions' => 'self',
        ]));

        Task::factory(20)->create(fn () => [
            'author_id' => fake()->randomElement($users)->id,
            'assigned_id' => fake()->optional(.8)->randomElement($users)?->id,
        ]);

        Task::factory(3)->create([
            'author_id' => $selfUser->id,
            'assigned_id' => $selfUser->id,
        ]);
    }
}
