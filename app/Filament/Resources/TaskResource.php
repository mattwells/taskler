<?php

namespace App\Filament\Resources;

use App\Enums\UserPermission;
use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->columnSpanFull()->required(),
                Forms\Components\DateTimePicker::make('due_at'),
                Forms\Components\TextInput::make('priority')->numeric()
                    ->minValue(1)
                    ->maxValue(10),
                Forms\Components\Select::make('status')->options([
                    'pending' => 'Pending',
                    'doing' => 'Doing',
                    'complete' => 'Complete',
                ]),
                Forms\Components\Select::make('assigned_id')->relationship('assigned', 'name'),
                Forms\Components\MarkdownEditor::make('description')->columnSpanFull(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('created_at')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('due_at')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('updated_at')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('priority')
                    ->numeric(),
                Infolists\Components\TextEntry::make('status'),
                Infolists\Components\TextEntry::make('author.name'),
                Infolists\Components\TextEntry::make('assigned.name'),
                Infolists\Components\TextEntry::make('description')
                    ->columnSpanFull()->markdown(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('priority')->sortable(),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('assigned.name'),
                Tables\Columns\TextColumn::make('due_at')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('assigned.name')
                    ->relationship('assigned', 'name')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (($user = auth()->user())->permissions == UserPermission::Self) {
            $query->where(
                fn(Builder $query) => $query->where('author_id', $user->id)
                    ->orWhere('assigned_id', $user->id)
            );
        }

        return $query;
    }
}
