<?php

namespace App\Filament\Resources\Sales;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\UnitOfMeasurement;
use App\Filament\Resources\Sales\SaleItemResource\Pages;
use App\Filament\Resources\Sales\SaleItemResource\RelationManagers;
use App\Models\Sales\SaleItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleItemResource extends Resource
{
    protected static ?string $model = SaleItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sale_id')
                    ->relationship('sale', 'id')
                    ->label(__('models.sale'))
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label(__('models.product'))
                    ->required(),
                Forms\Components\TextInput::make('discount_percentage')
                    ->required()
                    ->label(__('models.discount_percentage'))
                    ->numeric(),
                Forms\Components\Select::make('unit_of_measurement')
                    ->options(self::getUnitOfMeasurement())
                    ->searchable()
                    ->required()
                    ->label(__('models.unit_of_measurement')),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity')),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
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
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->label(__('models.subtotal'))
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->label(__('models.total'))
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sale.id')
                    ->numeric()
                    ->label(__('models.sale'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->label(__('models.product'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_percentage')
                    ->numeric()
                    ->label(__('models.discount_percentage'))
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->label(__('models.subtotal'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label(__('models.total'))
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

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
    }

    public static function getCurrencySymbol(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
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
            'index' => Pages\ListSaleItems::route('/'),
            'create' => Pages\CreateSaleItem::route('/create'),
            'view' => Pages\ViewSaleItem::route('/{record}'),
            'edit' => Pages\EditSaleItem::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.sale_items');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    { 
        return __('models.sales');
    }
}
