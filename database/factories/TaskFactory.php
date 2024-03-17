<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(30),
            'description' => fake()->text,
            'due_at' => fake()->optional(.8)->dateTimeThisYear,
            'priority' => fake()->optional(.8)->numberBetween(1, 10),
            'status' => fake()->randomElement(['pending', 'doing', 'complete']),
        ];
    }
}
