<?php

namespace App\Filament\Resources\Inventories;

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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack'; 

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('stock_quantity')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('last_restocked_at'),
                Forms\Components\DateTimePicker::make('next_restock_date'),
                Forms\Components\TextInput::make('inventory_value')
                    ->numeric(),
                Forms\Components\TextInput::make('warehouse_location')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('storage_conditions')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('holding_cost')
                    ->numeric(),
                Forms\Components\TextInput::make('cost_of_goods_sold')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('last_audit_date'),
                Forms\Components\DateTimePicker::make('next_audit_date'),
                Forms\Components\Select::make('inventory_status')
                    ->options(self::getInventoryStatus())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('inventory_manager')
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('stock_quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_restocked_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_restock_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_value')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('warehouse_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('holding_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost_of_goods_sold')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_audit_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_audit_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_status'),
                Tables\Columns\TextColumn::make('inventory_manager')
                    ->searchable(),
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

    public static function getInventoryStatus(): array
    {
        return array_map(fn($case) => $case->value, InventoryStatus::cases());
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
