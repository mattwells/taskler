<?php

namespace App\Observers;

use App\Mail\TaskAssigned;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->notifyAssignedUserOfTask($task);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        if (!array_key_exists('assigned_id', $task->getDirty())) return;

        $this->notifyAssignedUserOfTask($task);
    }

    private function notifyAssignedUserOfTask(Task $task): void
    {
        Mail::to($task->assigned)->queue(new TaskAssigned($task));
    }
}
