<?php

namespace App\Filament\Resources\Employees;

use App\Enums\CurrencySymbol;
use App\Filament\Resources\Employees\BonusResource\Pages;
use App\Filament\Resources\Employees\BonusResource\RelationManagers;
use App\Models\Employees\Bonus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BonusResource extends Resource
{
    protected static ?string $model = Bonus::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('salary_id')
                    ->relationship('salary.employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->label(__('models.currency_symbol'))
                    ->default('USD $')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->label(__('models.amount')),
                Forms\Components\TextInput::make('type')
                    ->maxLength(255)
                    ->label(__('models.type')),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\DatePicker::make('date_awarded')
                    ->label(__('models.date_awarded')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('salary.employee.name')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol'))
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->label(__('models.amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.type')),
                Tables\Columns\TextColumn::make('date_awarded')
                    ->date()
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->label(__('models.date_awarded'))
                    ->sortable(),
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
            'index' => Pages\ListBonuses::route('/'),
            'create' => Pages\CreateBonus::route('/create'),
            'view' => Pages\ViewBonus::route('/{record}'),
            'edit' => Pages\EditBonus::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.bonuses');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}
