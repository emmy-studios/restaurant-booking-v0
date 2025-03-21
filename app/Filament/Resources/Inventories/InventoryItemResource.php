<?php

namespace App\Filament\Resources\Inventories;

use App\Enums\UnitOfMeasurement;
use App\Filament\Resources\Inventories\InventoryItemResource\Pages;
use App\Filament\Resources\Inventories\InventoryItemResource\RelationManagers;
use App\Models\Inventories\InventoryItem;
use App\Enums\CurrencySymbol;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryItemResource extends Resource
{
    protected static ?string $model = InventoryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    public static function getBreadcrumb(): string
    {
        return __('models.items');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('name')
                            ->label(__('models.name')),
                        Select::make('inventory_id')
                            ->relationship('inventory', 'inventory_code')
                            ->label(__('models.inventory'))
                            ->required(),
                        DatePicker::make('expiration_date')
                            ->label(__('models.expiration_date')),
                        TextInput::make('batch_number')
                            ->maxLength(255)
                            ->label(__('models.batch_number')),
                    ]),
                    Section::make([
                        FileUpload::make('image_url')
                            ->disk('public')
                            ->directory('inventory-images')
                            ->image()
                            ->previewable(false)
                            ->label(__('models.image_url'))
                            ->required(),
                        TextInput::make('barcode')
                            ->label(__('models.barcode')),
                        TextInput::make(__('models.sku')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    Select::make('unit_of_measurement')
                        ->options(UnitOfMeasurement::class)
                        ->label(__('models.unit_of_measurement'))
                        ->searchable()
                        ->required(),
                    TextInput::make('quantity')
                        ->numeric()
                        ->label(__('models.quantity')),
                    Select::make('currency')
                        ->options(CurrencySymbol::class)
                        ->default('USD $')
                        ->searchable()
                        ->label(__('models.currency')),
                    TextInput::make('unit_price')
                        ->numeric()
                        ->label(__('models.unit_price'))
                        ->default(0),
                ])
                    ->columns(2),
                Section::make([
                    MarkdownEditor::make('description')
                        ->required()
                        ->label(__('models.description')),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('inventory.inventory_code')
                    ->label(__('models.inventory'))
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name'))
                    ->sortable()
                    ->words(10),
                TextColumn::make('expiration_date')
                    ->date()
                    ->badge()
                    ->color('danger')
                    ->icon('heroicon-o-calendar-date-range')
                    ->label(__('models.expiration_date'))
                    ->sortable(),
                TextColumn::make('unit_of_measurement')
                    ->label(__('models.unit_of_measurement'))
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-o-scale')
                    ->formatStateUsing(fn ($record) => UnitOfMeasurement::from($record->unit_of_measurement)->getLabel()),
                TextColumn::make('quantity')
                    ->numeric()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-hashtag')
                    ->label(__('models.quantity'))
                    ->sortable(),
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
                ActionGroup::make([
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
