<?php

namespace App\Filament\Resources\Employees;

use App\Enums\WorkShift;
use App\Enums\WorkType;
use App\Filament\Resources\Employees\ScheduleResource\Pages;
use App\Filament\Resources\Employees\ScheduleResource\RelationManagers;
use App\Models\Employees\Schedule;
use Filament\Forms;
use Filament\Forms\Form; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\TextInput::make('shift_start_time'),
                Forms\Components\TextInput::make('shift_end_time'),
                Forms\Components\Select::make('work_shift')
                    ->options(WorkShift::class)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('work_type')
                    ->options(WorkType::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('total_work_hours')
                    ->numeric(),
                Forms\Components\TextInput::make('lunch_break_duration')
                    ->numeric(),
                Forms\Components\TextInput::make('overtime_hours')
                    ->numeric(),
                Forms\Components\TextInput::make('overtime_rate')
                    ->numeric(),
                Forms\Components\DatePicker::make('schedule_start_date'),
                Forms\Components\DatePicker::make('schedule_end_date'),
                Forms\Components\DatePicker::make('modified_date'),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shift_start_time'),
                Tables\Columns\TextColumn::make('shift_end_time'),
                Tables\Columns\TextColumn::make('work_shift')
                    ->badge(),
                Tables\Columns\TextColumn::make('work_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('total_work_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('modified_date')
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'view' => Pages\ViewSchedule::route('/{record}'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.schedules');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }

}
