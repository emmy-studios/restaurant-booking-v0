<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\InventoryMovementType;
use App\Filament\Resources\Inventories\InventoryMovementResource\Pages;
use App\Filament\Resources\Inventories\InventoryMovementResource\RelationManagers;
use App\Models\Inventories\InventoryMovement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryMovementResource extends Resource
{
    protected static ?string $model = InventoryMovement::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-circle'; 

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('inventory_id')
                    ->relationship('inventory', 'id')
                    ->label(__('models.inventory'))
                    ->required(),
                Forms\Components\Select::make('inventory_item_id')
                    ->relationship('inventoryItem', 'id')
                    ->label(__('models.inventory_item')),
                Forms\Components\Select::make('movement_type')
                    ->options(self::getMovementType())
                    ->searchable()
                    ->label(__('models.movement_type'))
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->label(__('models.quantity'))
                    ->numeric(),
                Forms\Components\TextInput::make('previous_quantity')
                    ->numeric()
                    ->label(__('models.previous_quantity')),
                Forms\Components\TextInput::make('new_quantity')
                    ->numeric()
                    ->label(__('models.new_quantity')),
                Forms\Components\MarkdownEditor::make('reason')
                    ->columnSpanFull()
                    ->label(__('models.reason')),
                Forms\Components\TextInput::make('performed_by')
                    ->maxLength(255)
                    ->label(__('models.performed_by')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inventory.id')
                    ->numeric()
                    ->label(__('models.inventory'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventoryItem.id')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.inventory_item')),
                Tables\Columns\TextColumn::make('movement_type')
                    ->label(__('models.movement_type')),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('previous_quantity')
                    ->numeric()
                    ->label(__('models.previous_quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('new_quantity')
                    ->numeric()
                    ->label(__('models.new_quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('performed_by')
                    ->searchable()
                    ->label(__('models.performed_by')),
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

    public static function getMovementType(): array
    {
        return array_map(fn($case) => $case->value, InventoryMovementType::cases());
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
            'index' => Pages\ListInventoryMovements::route('/'),
            'create' => Pages\CreateInventoryMovement::route('/create'),
            'view' => Pages\ViewInventoryMovement::route('/{record}'),
            'edit' => Pages\EditInventoryMovement::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.inventory_movements');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.inventories');
    }
}
