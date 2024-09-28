<?php

namespace App\Filament\Resources\Purchases;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\UnitOfMeasurement;
use App\Filament\Resources\Purchases\PurchaseItemResource\Pages;
use App\Filament\Resources\Purchases\PurchaseItemResource\RelationManagers;
use App\Models\Purchases\PurchaseItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseItemResource extends Resource
{
    protected static ?string $model = PurchaseItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('purchase_id')
                    ->relationship('purchase', 'id')
                    ->label(__('models.purchase'))
                    ->required(),
                Forms\Components\TextInput::make('product_name')
                    ->maxLength(255)
                    ->label(__('models.product')),
                Forms\Components\Select::make('unit_of_measurement')
                    ->options(self::getUnitOfMeasurement())
                    ->searchable()
                    ->default('unit')
                    ->required() 
                    ->label(__('models.unit_of_measurement')),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity')),
                Forms\Components\Select::make('currency_code')
                    ->options(self::getCurrencyCode())
                    ->searchable()
                    ->default('USD')
                    ->required()
                    ->label(__('models.currency_code')),
                Forms\Components\Select::make('currency_symbol')
                    ->options(self::getCurrencySymbol())
                    ->searchable()
                    ->default('USD $')
                    ->required()
                    ->label(__('models.currency_symbol')),
                Forms\Components\TextInput::make('unit_price')
                    ->numeric()
                    ->label(__('models.unit_price')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchase.id')
                    ->numeric()
                    ->label(__('models.purchase'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable()
                    ->label(__('models.product')),
                Tables\Columns\TextColumn::make('unit_of_measurement')
                    ->label(__('models.unit_of_measurement')),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
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

    public static function getUnitOfMeasurement(): array
    {
        return array_map(fn($case) => $case->value, UnitOfMeasurement::cases());
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
            'index' => Pages\ListPurchaseItems::route('/'),
            'create' => Pages\CreatePurchaseItem::route('/create'),
            'view' => Pages\ViewPurchaseItem::route('/{record}'),
            'edit' => Pages\EditPurchaseItem::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.purchase_items');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    { 
        return __('models.purchases');
    }
}
