<?php

namespace App\Filament\Resources\Menus;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Menus\MenuPriceResource\Pages;
use App\Filament\Resources\Menus\MenuPriceResource\RelationManagers;
use App\Models\Menus\MenuPrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuPriceResource extends Resource
{
    protected static ?string $model = MenuPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-euro';

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
                Forms\Components\Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $')
                    ->required() 
                    ->label(__('models.currency_symbol')),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->label(__('models.price'))
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->label(__('models.price'))
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

    public static function getCurrencySymbol(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
    }

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
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
            'index' => Pages\ListMenuPrices::route('/'),
            'create' => Pages\CreateMenuPrice::route('/create'),
            'view' => Pages\ViewMenuPrice::route('/{record}'),
            'edit' => Pages\EditMenuPrice::route('/{record}/edit'),
        ];
    } 

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.menu_prices');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.menus');
    }
}
