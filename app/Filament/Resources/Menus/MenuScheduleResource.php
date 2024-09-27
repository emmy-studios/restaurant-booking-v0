<?php

namespace App\Filament\Resources\Menus;

use App\Enums\DayOfWeek;
use App\Filament\Resources\Menus\MenuScheduleResource\Pages;
use App\Filament\Resources\Menus\MenuScheduleResource\RelationManagers;
use App\Models\Menus\MenuSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuScheduleResource extends Resource
{
    protected static ?string $model = MenuSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('menu_id')
                    ->relationship('menu', 'title')
                    ->label(__('models.menu'))
                    ->required(),
                Forms\Components\Select::make('day_of_week')
                    ->options(self::getDayOfWeek())
                    ->searchable()
                    ->label(__('models.day_of_week')),
                Forms\Components\TimePicker::make('start_time')
                    ->label(__('models.start_time')),
                Forms\Components\TimePicker::make('end_time')
                    ->label(__('models.end_time')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('menu.title')
                    ->numeric()
                    ->label(__('models.menu'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label(__('models.day_of_week')),
                Tables\Columns\TextColumn::make('start_time')
                    ->label(__('models.start_time')),
                Tables\Columns\TextColumn::make('end_time')
                    ->label(__('models.end_time')),
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

    public static function getDayOfWeek(): array
    {
        return array_map(fn($case) => $case->value, DayOfWeek::cases());
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
            'index' => Pages\ListMenuSchedules::route('/'),
            'create' => Pages\CreateMenuSchedule::route('/create'),
            'view' => Pages\ViewMenuSchedule::route('/{record}'),
            'edit' => Pages\EditMenuSchedule::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.menu_schedules');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.menus');
    }
}
