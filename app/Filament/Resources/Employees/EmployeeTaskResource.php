<?php

namespace App\Filament\Resources\Employees;

use App\Enums\TaskStatus;
use App\Filament\Resources\Employees\EmployeeTaskResource\Pages;
use App\Filament\Resources\Employees\EmployeeTaskResource\RelationManagers;
use App\Models\Employees\EmployeeTask;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeTaskResource extends Resource
{
    protected static ?string $model = EmployeeTask::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\TextInput::make('task_name')
                    ->required()
                    ->label(__('models.task_name'))
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->label(__('models.description'))
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
                Forms\Components\Select::make('status')
                    ->options(TaskStatus::class)
                    ->searchable()
                    ->label(__('models.status'))
                    ->required(),
                Forms\Components\Toggle::make('is_read')
                    ->label(__('models.is_read')),
                Forms\Components\DateTimePicker::make('due_date')
                    ->label(__('models.due_date')),
                Forms\Components\Select::make('supervisor_id')
                    ->relationship('supervisor', 'name')
                    ->label(__('models.supervisor')),
                Forms\Components\MarkdownEditor::make('supervisor_comment')
                    ->columnSpanFull()
                    ->label(__('models.supervisor_comment')),
                Forms\Components\MarkdownEditor::make('employee_notes')
                    ->label(__('models.employee_notes'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.task_name')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color('info')
                    ->label(__('models.status')),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('models.is_read')),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->label(__('models.due_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('supervisor_id')
                    ->sortable()
                    ->searchable()
                    ->label(__('models.supervised_by')),
                Tables\Columns\TextColumn::make('supervisor_comment')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->iconColor('gray')
                    ->label(__('models.supervisor_comment'))
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employee_notes')
                    ->label(__('models.employee_notes'))
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployeeTasks::route('/'),
            'create' => Pages\CreateEmployeeTask::route('/create'),
            'view' => Pages\ViewEmployeeTask::route('/{record}'),
            'edit' => Pages\EditEmployeeTask::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.tasks');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}
