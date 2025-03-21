<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\CurrencySymbol;
use App\Enums\InventoryStatus;
use App\Filament\Resources\Inventories\InventoryResource\Pages;
use App\Filament\Resources\Inventories\InventoryResource\RelationManagers;
use App\Models\Inventories\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    public static function getBreadcrumb(): string
    {
        return __('models.inventories');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('inventory_code')
                            ->label(__('models.inventory_code'))
                            ->default('IN-' . random_int(100000, 999999999)),
                        TextInput::make('total_quantity')
                            ->required()
                            ->numeric()
                            ->label(__('models.total_quantity'))
                            ->default(0),
                        Select::make('inventory_status')
                            ->options(InventoryStatus::class)
                            ->label(__('models.inventory_status'))
                            ->searchable()
                            ->default('Active')
                            ->required(),
                    ]),
                    Section::make([
                        DateTimePicker::make('last_restocked_at')
                            ->label(__('models.last_restocked_at')),
                        DateTimePicker::make('next_restock_date')
                            ->label(__('models.next_restock_date')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    Select::make('currency')
                        ->label(__('models.currency'))
                        ->options(CurrencySymbol::class)
                        ->searchable()
                        ->default('USD $')
                        ->required(),
                    TextInput::make('inventory_value')
                        ->numeric()
                        ->default(0)
                        ->label(__('models.inventory_value')),
                    TextInput::make('holding_cost')
                        ->numeric()
                        ->default(0)
                        ->label(__('models.holding_cost')),
                    TextInput::make('cost_of_goods_sold')
                        ->numeric()
                        ->default(0)
                        ->label(__('models.cost_of_goods_sold')),
                ])->columns(2),
                Split::make([
                    Section::make([
                        TextInput::make('warehouse_location')
                            ->maxLength(255)
                            ->label(__('models.warehouse_location')),
                        TextInput::make('inventory_manager')
                            ->maxLength(255)
                            ->label(__('models.inventory_manager')),
                    ]),
                    Section::make([
                        DateTimePicker::make('last_audit_date')
                            ->label(__('models.last_audit_date')),
                        DateTimePicker::make('next_audit_date')
                            ->label(__('models.next_audit_date')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('storage_conditions')
                        ->columnSpanFull()
                        ->label(__('models.storage_conditions')),
                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->label(__('models.description')),
                    MarkdownEditor::make('notes')
                        ->columnSpanFull()
                        ->label(__('models.notes'))
                ])
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
                Tables\Columns\TextColumn::make('inventory_status')
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(fn ($record) => InventoryStatus::from($record->inventory_status)->getLabel())
                    ->color(fn ($record) => InventoryStatus::from($record->inventory_status)->getColor())
                    ->label(__('models.inventory_status')),
                Tables\Columns\TextColumn::make('currency')
                    ->badge()
                    ->searchable()
                    ->color('info')
                    ->label(__('models.currency')),
                Tables\Columns\TextColumn::make('inventory_value')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.inventory_value')),
                Tables\Columns\TextColumn::make('holding_cost')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.holding_cost'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cost_of_goods_sold')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.cost_of_goods_sold'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_restocked_at')
                    ->dateTime()
                    ->label(__('models.last_restocked_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('next_restock_date')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.next_restock_date')),
                Tables\Columns\TextColumn::make('warehouse_location')
                    ->searchable()
                    ->label(__('models.warehouse_location'))
                    ->limit(15)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('last_audit_date')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->label(__('models.last_audit_date'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('next_audit_date')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->label(__('models.next_audit_date'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('inventory_manager')
                    ->searchable()
                    ->label(__('models.inventory_manager'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(16),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
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
