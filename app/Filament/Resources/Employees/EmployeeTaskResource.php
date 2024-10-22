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
                    ->required(),
                Forms\Components\TextInput::make('task_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(TaskStatus::class)
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('due_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
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
