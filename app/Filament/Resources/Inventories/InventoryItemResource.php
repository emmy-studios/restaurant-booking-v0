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

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ingredient_id') 
                    ->relationship('ingredient', 'name')
                    ->label(__('models.ingredient'))
                    ->required(),
                Forms\Components\Select::make('inventory_id')
                    ->relationship('inventory', 'id')
                    ->label(__('models.inventory'))
                    ->required(),
                Forms\Components\TextInput::make('batch_number')
                    ->maxLength(255)
                    ->label(__('models.batch_number')),
                Forms\Components\DatePicker::make('expiration_date')
                    ->label(__('models.expiration_date')),
                Forms\Components\Select::make('unit_of_measurement')
                    ->options(self::getUnitOfMeasurement())
                    ->label(__('models.unit_of_measurement'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ingredient.name')
                    ->numeric()
                    ->label(__('models.ingredient'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory.id')
                    ->numeric()
                    ->label(__('models.inventory'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('batch_number')
                    ->searchable()
                    ->label(__('models.batch_number')),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->date()
                    ->label(__('models.expiration_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_of_measurement')
                    ->label(__('models.unit_of_measurement')),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
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
        return __('models.inventory_item');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.inventories');
    }
}
