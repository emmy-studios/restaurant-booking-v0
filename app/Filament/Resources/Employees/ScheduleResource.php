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
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\TimePicker::make('shift_start_time')
                    ->label(__('models.shift_start_time'))
                    ->seconds(false),
                Forms\Components\TimePicker::make('shift_end_time')
                    ->label(__('models.shift_end_time'))
                    ->seconds(false),
                Forms\Components\Select::make('work_shift')
                    ->options(WorkShift::class)
                    ->searchable()
                    ->label(__('models.work_shift'))
                    ->required(),
                Forms\Components\Select::make('work_type')
                    ->options(WorkType::class)
                    ->label(__('models.work_type'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('total_work_hours')
                    ->numeric()
                    ->label(__('models.total_work_hours')),
                Forms\Components\TextInput::make('lunch_break_duration')
                    ->numeric()
                    ->label(__('models.lunch_break_duration')),
                Forms\Components\TextInput::make('overtime_hours')
                    ->numeric()
                    ->label(__('models.overtime_hours')),
                Forms\Components\TextInput::make('overtime_rate')
                    ->numeric()
                    ->label(__('models.overtime_rate')),
                Forms\Components\DatePicker::make('schedule_start_date')
                    ->label(__('models.schedule_start_date')),
                Forms\Components\DatePicker::make('schedule_end_date')
                    ->label(__('models.schedule_end_date')),
                Forms\Components\DatePicker::make('modified_date')
                    ->label(__('models.modified_date')),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('shift_start_time')
                    ->label(__('models.shift_start_time')),
                Tables\Columns\TextColumn::make('shift_end_time')
                    ->label(__('models.shift_end_time')),
                Tables\Columns\TextColumn::make('work_shift')
                    ->badge()
                    ->label(__('models.work_shift')),
                Tables\Columns\TextColumn::make('work_type')
                    ->badge()
                    ->label(__('models.work_type')),
                Tables\Columns\TextColumn::make('total_work_hours')
                    ->numeric()
                    ->label(__('models.total_work_hours'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->label(__('models.lunch_break_duration'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_hours')
                    ->numeric()
                    ->label(__('models.overtime_hours'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_rate')
                    ->numeric()
                    ->label(__('models.overtime_rate'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_start_date')
                    ->date()
                    ->label(__('models.schedule_start_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_end_date')
                    ->date()
                    ->label(__('models.schedule_end_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('modified_date')
                    ->date()
                    ->label(__('models.modified_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
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
