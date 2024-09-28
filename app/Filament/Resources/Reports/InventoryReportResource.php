<?php

namespace App\Filament\Resources\Reports;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Reports\InventoryReportResource\Pages;
use App\Filament\Resources\Reports\InventoryReportResource\RelationManagers;
use App\Models\Reports\InventoryReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryReportResource extends Resource
{
    protected static ?string $model = InventoryReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;
 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('report_date')
                    ->label(__('models.report_date'))
                    ->required(),
                Forms\Components\TextInput::make('inventory_location')
                    ->maxLength(255)
                    ->label(__('models.inventory_location')),
                Forms\Components\Select::make('currency_code')
                    ->options(self::getCurrencyCode())
                    ->searchable()
                    ->default('USD')
                    ->label(__('models.currency_code'))
                    ->required(),
                Forms\Components\Select::make('currency_symbol')
                    ->options(self::getCurrencySymbol())
                    ->searchable()
                    ->default('USD $')
                    ->label(__('models.currency_symbol'))
                    ->required(),
                Forms\Components\TextInput::make('total_stock_value')
                    ->required()
                    ->label(__('models.total_stock_value'))
                    ->numeric(),
                Forms\Components\TextInput::make('total_items_in_stock')
                    ->numeric()
                    ->label(__('models.total_items_in_stock')),
                Forms\Components\TextInput::make('total_expired_items')
                    ->numeric()
                    ->label(__('models.total_expired_items')),
                Forms\Components\TextInput::make('items_expiring_soon')
                    ->numeric()
                    ->label(__('models.items_expiring_soon')),
                Forms\Components\MarkdownEditor::make('most_used_items')
                    ->columnSpanFull()
                    ->label(__('models.most_used_items')),
                Forms\Components\MarkdownEditor::make('least_used_items')
                    ->columnSpanFull()
                    ->label(__('models.least_used_items')),
                Forms\Components\TextInput::make('total_used_items_value')
                    ->numeric()
                    ->label(__('models.total_used_items_value')),
                Forms\Components\MarkdownEditor::make('restock_needed_items')
                    ->columnSpanFull()
                    ->label(__('models.restock_needed_items')),
                Forms\Components\MarkdownEditor::make('stock_wastage')
                    ->columnSpanFull()
                    ->label(__('models.stock_wastage')),
                Forms\Components\TextInput::make('stock_wastage_value')
                    ->numeric()
                    ->label(__('models.stock_wastage_value')),
                Forms\Components\DateTimePicker::make('last_audit_date')
                    ->label(__('models.last_audit_date')),
                Forms\Components\DateTimePicker::make('next_audit_date')
                    ->label(__('models.next_audit_date')),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label(__('models.user')),
                Forms\Components\MarkdownEditor::make('report_notes')
                    ->columnSpanFull()
                    ->label(__('models.report_notes')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('report_date')
                    ->dateTime()
                    ->label(__('models.report_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_location')
                    ->searchable()
                    ->label(__('models.inventory_location')),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('total_stock_value')
                    ->numeric()
                    ->label(__('models.total_stock_value'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_items_in_stock')
                    ->numeric()
                    ->label(__('models.total_items_in_stock'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_expired_items')
                    ->numeric()
                    ->label(__('models.total_expired_items'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_expiring_soon')
                    ->numeric()
                    ->label(__('models.items_expiring_soon'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_used_items_value')
                    ->numeric()
                    ->label(__('models.total_used_items_value'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock_wastage_value')
                    ->numeric()
                    ->label(__('models.stock_wastage_value'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_audit_date')
                    ->dateTime()
                    ->label(__('models.last_audit_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('next_audit_date')
                    ->dateTime()
                    ->label(__('models.next_audit_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.user'))
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
            'index' => Pages\ListInventoryReports::route('/'),
            'create' => Pages\CreateInventoryReport::route('/create'),
            'view' => Pages\ViewInventoryReport::route('/{record}'),
            'edit' => Pages\EditInventoryReport::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.inventory_reports');
    } 
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    { 
        return __('models.reports');
    }
}
 