<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'todo' => Tab::make('Todo')
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereNot('status', TaskStatus::Complete)
                ),
            'overdue' => Tab::make('Overdue')
                ->modifyQueryUsing(
                    fn(Builder $query) => $query->whereNot('status', TaskStatus::Complete)
                        ->where('due_at', '<', Carbon::now())
                ),
        ];
    }
}
