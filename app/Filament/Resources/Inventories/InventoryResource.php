<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\CurrencySymbol;
use App\Enums\InventoryStatus;
use App\Filament\Resources\Inventories\InventoryResource\Pages;
use App\Filament\Resources\Inventories\InventoryResource\RelationManagers;
use App\Models\Inventories\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
 
class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;
 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('total_quantity')
                    ->required()
                    ->numeric()
                    ->label(__('models.total_quantity'))
                    ->default(0.00), 
                Forms\Components\DateTimePicker::make('last_restocked_at')
                    ->label(__('models.last_restocked_at')),
                Forms\Components\DateTimePicker::make('next_restock_date')
                    ->label(__('models.next_restock_date')),
                Forms\Components\TextInput::make('warehouse_location')
                    ->maxLength(255)
                    ->label(__('models.warehouse_location')),
                Forms\Components\MarkdownEditor::make('storage_conditions')
                    ->columnSpanFull()
                    ->label(__('models.storage_conditions')),
                Forms\Components\Select::make('currency') 
                    ->label(__('models.currency'))
                    ->options(self::getCurrencySymbol())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('inventory_value')
                    ->numeric()
                    ->label(__('models.inventory_value')),
                Forms\Components\TextInput::make('holding_cost')
                    ->numeric()
                    ->label(__('models.holding_cost')),
                Forms\Components\TextInput::make('cost_of_goods_sold')
                    ->numeric()
                    ->label(__('models.cost_of_goods_sold')),
                Forms\Components\DateTimePicker::make('last_audit_date')
                    ->label(__('models.last_audit_date')),
                Forms\Components\DateTimePicker::make('next_audit_date')
                    ->label(__('models.next_audit_date')),
                Forms\Components\Select::make('inventory_status')
                    ->options(self::getInventoryStatus())
                    ->label(__('models.inventory_status'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('inventory_manager')
                    ->maxLength(255)
                    ->label(__('models.inventory_manager')),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('total_quantity')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.total_quantity')),
                Tables\Columns\TextColumn::make('last_restocked_at')
                    ->dateTime()
                    ->label(__('models.last_restocked_at'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_restock_date')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.next_restock_date')),
                Tables\Columns\TextColumn::make('warehouse_location')
                    ->searchable()
                    ->label(__('models.warehouse_location')),
                Tables\Columns\TextColumn::make('currency')
                    ->label(__('models.currency')),
                Tables\Columns\TextColumn::make('inventory_value')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.inventory_value')),
                Tables\Columns\TextColumn::make('holding_cost')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.holding_cost')),
                Tables\Columns\TextColumn::make('cost_of_goods_sold')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.cost_of_goods_sold')),
                Tables\Columns\TextColumn::make('last_audit_date')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.last_audit_date')),
                Tables\Columns\TextColumn::make('next_audit_date')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.next_audit_date')),
                Tables\Columns\TextColumn::make('inventory_status')
                    ->label(__('models.inventory_status')),
                Tables\Columns\TextColumn::make('inventory_manager')
                    ->searchable()
                    ->label(__('models.inventory_manager')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.updated_at'))
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

    public static function getInventoryStatus(): array
    {
        return array_map(fn($case) => $case->value, InventoryStatus::cases());
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'view' => Pages\ViewInventory::route('/{record}'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.inventories');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.inventories');
    }
}
