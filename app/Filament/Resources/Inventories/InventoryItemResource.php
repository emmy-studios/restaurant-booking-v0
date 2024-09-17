<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\UnitOfMeasurement;
use App\Filament\Resources\Inventories\InventoryItemResource\Pages;
use App\Filament\Resources\Inventories\InventoryItemResource\RelationManagers;
use App\Models\Inventories\InventoryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryItemResource extends Resource
{
    protected static ?string $model = InventoryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ingredient_id')
                    ->relationship('ingredient', 'name')
                    ->required(),
                Forms\Components\Select::make('inventory_id') 
                    ->relationship('inventory', 'id')
                    ->required(),
                Forms\Components\TextInput::make('batch_number')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('expiration_date'),
                Forms\Components\Select::make('unit_of_measurement')
                    ->options(self::getUnitOfMeasurements())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ingredient.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('batch_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_of_measurement'),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
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
 

    public static function getUnitOfMeasurements(): array
    {
        return array_map(fn($case) => $case->value, UnitOfMeasurement::cases());
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
            'index' => Pages\ListInventoryItems::route('/'),
            'create' => Pages\CreateInventoryItem::route('/create'),
            'view' => Pages\ViewInventoryItem::route('/{record}'),
            'edit' => Pages\EditInventoryItem::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.inventory_items');
    } 
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.inventories');
    }
}
