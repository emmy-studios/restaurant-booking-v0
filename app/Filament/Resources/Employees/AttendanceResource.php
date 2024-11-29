<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\AttendanceResource\Pages;
use App\Filament\Resources\Employees\AttendanceResource\RelationManagers;
use App\Models\Employees\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                DatePicker::make('date')
                    ->label(__('models.date')),
                TimePicker::make('check_in_time')
                    ->label(__('models.check_in_time')),
                TimePicker::make('check_out_time')
                    ->label(__('models.check_out_time')),
                TextInput::make('total_work_hours')
                    ->numeric()
                    ->label(__('models.total_work_hours')),
                TimePicker::make('break_start_time')
                    ->label(__('models.break_start_time')),
                TimePicker::make('break_end_time')
                    ->label(__('models.break_end_time')),
                TextInput::make('lunch_break_duration')
                    ->numeric()
                    ->label(__('models.lunch_break_duration')),
                Toggle::make('is_holiday')
                    ->required()
                    ->label(__('models.is_holiday')),
                Toggle::make('is_weekend')
                    ->required()
                    ->label(__('models.is_weekend')),
                MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.employee')),
                TextColumn::make('date')
                    ->icon('heroicon-o-calendar-days')
                    ->iconColor('info')
                    ->date()
                    ->label(__('models.date'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('check_in_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('success')
                    ->label(__('models.check_in_time')),
                TextColumn::make('check_out_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('success')
                    ->label(__('models.check_out_time')),
                TextColumn::make('total_work_hours')
                    ->numeric()
                    ->label(__('models.total_work_hours'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('break_start_time')
                    ->label(__('models.break_start_time'))
                    ->searchable()
                    ->icon('heroicon-o-clock')
                    ->iconColor('success')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('break_end_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('success')
                    ->label(__('models.break_end_time'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->label(__('models.lunch_break_duration'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_holiday')
                    ->boolean()
                    ->label(__('models.is_holiday'))
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_weekend')
                    ->boolean()
                    ->label(__('models.is_weekend'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'view' => Pages\ViewAttendance::route('/{record}'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.attendances');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}
