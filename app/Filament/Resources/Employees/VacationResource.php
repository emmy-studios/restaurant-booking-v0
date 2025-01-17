<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\VacationResource\Pages;
use App\Filament\Resources\Employees\VacationResource\RelationManagers;
use App\Models\Employees\Vacation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VacationResource extends Resource
{
    protected static ?string $model = Vacation::class;

    protected static ?string $navigationIcon = 'heroicon-o-sun';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\TextInput::make('number_of_days')
                    ->required()
                    ->label(__('models.number_of_days'))
                    ->numeric(),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label(__('models.start_date')),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label(__('models.end_date')),
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
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_days')
                    ->numeric()
                    ->label(__('models.number_of_days'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->date()
                    ->label(__('models.start_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->date()
                    ->label(__('models.end_date'))
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
            'index' => Pages\ListVacations::route('/'),
            'create' => Pages\CreateVacation::route('/create'),
            'view' => Pages\ViewVacation::route('/{record}'),
            'edit' => Pages\EditVacation::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.vacations');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}
