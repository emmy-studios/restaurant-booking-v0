<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\PriceResource\Pages;
use App\Filament\Resources\Products\PriceResource\RelationManagers;
use App\Models\Products\Price;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceResource extends Resource
{
    protected static ?string $model = Price::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar'; 

    protected static ?string $navigationLabel = null;
 
    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label(__('models.product'))
                    ->required(),
                Forms\Components\Select::make('currency_id')
                    ->relationship('currency', 'currency_symbol')
                    ->label(__('models.currency'))
                    ->required(),
                Forms\Components\TextInput::make('unit_price') 
                    ->required()
                    ->label(__('models.unit_price'))
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->label(__('models.product'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency.currency_symbol')
                    ->numeric()
                    ->label(__('models.currency'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->numeric()
                    ->label(__('models.unit_price'))
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
            'index' => Pages\ListPrices::route('/'),
            'create' => Pages\CreatePrice::route('/create'),
            'view' => Pages\ViewPrice::route('/{record}'),
            'edit' => Pages\EditPrice::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.prices');
    }
  
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.products');
    }
}
