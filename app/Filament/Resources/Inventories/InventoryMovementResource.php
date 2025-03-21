<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\InventoryMovementType;
use App\Filament\Resources\Inventories\InventoryMovementResource\Pages;
use App\Filament\Resources\Inventories\InventoryMovementResource\RelationManagers;
use App\Models\Inventories\InventoryMovement;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryMovementResource extends Resource
{
    protected static ?string $model = InventoryMovement::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-left-circle';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    public static function getBreadcrumb(): string
    {
        return __('models.movements');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('inventory_id')
                            ->relationship('inventory', 'inventory_code')
                            ->label(__('models.inventory'))
                            ->required(),
                        Select::make('inventory_item_id')
                            ->relationship('inventoryItem', 'name')
                            ->label(__('models.inventory_item')),
                        Select::make('movement_type')
                            ->options(self::getMovementType())
                            ->searchable()
                            ->label(__('models.movement_type'))
                            ->required(),
                    ]),
                    Section::make([
                        TextInput::make('quantity')
                            ->required()
                            ->label(__('models.quantity'))
                            ->numeric(),
                        TextInput::make('previous_quantity')
                            ->numeric()
                            ->label(__('models.previous_quantity')),
                        TextInput::make('new_quantity')
                            ->numeric()
                            ->label(__('models.new_quantity')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('reason')
                        ->columnSpanFull()
                        ->label(__('models.reason')),
                    TextInput::make('performed_by')
                        ->maxLength(255)
                        ->label(__('models.performed_by'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inventory.id')
                    ->numeric()
                    ->label(__('models.inventory'))
                    ->sortable(),
                TextColumn::make('inventoryItem.id')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.inventory_item')),
                TextColumn::make('movement_type')
                    ->label(__('models.movement_type')),
                TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                TextColumn::make('previous_quantity')
                    ->numeric()
                    ->label(__('models.previous_quantity'))
                    ->sortable(),
                TextColumn::make('new_quantity')
                    ->numeric()
                    ->label(__('models.new_quantity'))
                    ->sortable(),
                TextColumn::make('performed_by')
                    ->searchable()
                    ->label(__('models.performed_by')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
