<?php

namespace App\Filament\Resources\Reports;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Reports\DailySaleReportResource\Pages;
use App\Filament\Resources\Reports\DailySaleReportResource\RelationManagers;
use App\Models\Reports\DailySaleReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailySaleReportResource extends Resource
{
    protected static ?string $model = DailySaleReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('report_date')
                    ->label(__('models.report_date'))
                    ->required(),
                Forms\Components\TextInput::make('total_orders') 
                    ->numeric()
                    ->label(__('models.total_orders')),
                Forms\Components\TextInput::make('total_sales')
                    ->numeric()
                    ->label(__('models.total_sales')),
                Forms\Components\Select::make('sales_currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $')
                    ->required()
                    ->label(__('models.currency_symbol')),
                Forms\Components\TextInput::make('sales_subtotal')
                    ->required()
                    ->label(__('models.sales_subtotal'))
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('sales_discounts_applied')
                    ->numeric()
                    ->label(__('models.sales_discounts_applied')),
                Forms\Components\TextInput::make('discount_total_amount')
                    ->required()
                    ->label(__('models.discount_total_amount'))
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_net_amount')
                    ->required()
                    ->label(__('models.total_net_amount'))
                    ->numeric()
                    ->default(0.00),
                Forms\Components\MarkdownEditor::make('details')
                    ->columnSpanFull()
                    ->label(__('models.details')),
                Forms\Components\MarkdownEditor::make('notes')
                    ->columnSpanFull()
                    ->label(__('models.notes')),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.employee'))
                    ->required(),
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
                Tables\Columns\TextColumn::make('total_orders')
                    ->numeric()
                    ->label(__('models.total_orders'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_sales')
                    ->numeric()
                    ->label(__('models.total_sales'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('sales_currency_symbol')
                    ->badge()
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('sales_subtotal')
                    ->label(__('models.sales_subtotal')),
                Tables\Columns\TextColumn::make('sales_discounts_applied')
                    ->numeric()
                    ->label(__('models.sales_discounts_applied'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount_total_amount')
                    ->numeric()
                    ->label(__('models.discount_total_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_net_amount')
                    ->numeric()
                    ->label(__('models.total_net_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.employee'))
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailySaleReports::route('/'),
            'create' => Pages\CreateDailySaleReport::route('/create'),
            'view' => Pages\ViewDailySaleReport::route('/{record}'),
            'edit' => Pages\EditDailySaleReport::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.daily_sale_reports');
    } 
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    { 
        return __('models.reports');
    }
}
