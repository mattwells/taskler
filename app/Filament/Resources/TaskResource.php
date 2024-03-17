<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
