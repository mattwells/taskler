<?php

namespace Tests\Feature;

use App\Mail\TaskAssigned;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_task_assignee_receives_email(): void
    {
        Mail::fake();

        [$author, $assignee] = User::factory(2)->create();

        Task::factory()->create([
            'author_id' => $author->id,
            'assigned_id' => $assignee->id,
        ]);

        Mail::assertQueued(TaskAssigned::class);
    }
}
