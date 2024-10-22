<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\AttendanceResource\Pages;
use App\Filament\Resources\Employees\AttendanceResource\RelationManagers;
use App\Models\Employees\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('date'),
                Forms\Components\TextInput::make('check_in_time'),
                Forms\Components\TextInput::make('check_out_time'),
                Forms\Components\TextInput::make('total_work_hours')
                    ->numeric(),
                Forms\Components\TextInput::make('overtime_hours')
                    ->numeric(),
                Forms\Components\TextInput::make('overtime_rate')
                    ->numeric(),
                Forms\Components\TextInput::make('lunch_break_duration')
                    ->numeric(),
                Forms\Components\Toggle::make('is_holiday')
                    ->required(),
                Forms\Components\Toggle::make('is_weekend')
                    ->required(),
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
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in_time'),
                Tables\Columns\TextColumn::make('check_out_time'),
                Tables\Columns\TextColumn::make('total_work_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_holiday')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_weekend')
                    ->boolean(),
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
