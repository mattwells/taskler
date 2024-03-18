You have been assigned the task <a href="{{ \App\Filament\Resources\TaskResource::getUrl('view', [$task]) }}">{{ $task->title }}</a> @if($task->due_at)
due on {{ $task->due_at }}.
@else
with no due date.
@endif

