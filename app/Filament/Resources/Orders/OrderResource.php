<?php

namespace App\Filament\Resources\Orders;

use App\Enums\CurrencySymbol;
use App\Enums\OrderSource;
use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\OrderResource\Pages;
use App\Filament\Resources\Orders\OrderResource\RelationManagers;
use App\Models\Orders\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->required()
                    ->label(__('models.order_code'))
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.user'))
                    ->required(),
                Forms\Components\Select::make('order_status')
                    ->options(OrderStatus::class)
                    ->searchable()
                    ->default('Processing')
                    ->label(__('models.order_status')),
                Forms\Components\Select::make('order_source')
                    ->options(OrderSource::class)
                    ->default('Online')
                    ->searchable()
                    ->label(__('models.order_source')),
                Forms\Components\Select::make('currency_symbol')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $')
                    ->label(__('models.currency_symbol')),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->label(__('models.subtotal'))
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->label(__('models.total'))
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label(__('models.order_code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->searchable()
                    ->label(__('models.user'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->badge()
                    ->color(fn ($record) => OrderStatus::from($record->order_status)->getColor())
                    ->searchable()
                    ->label(__('models.order_status')),
                Tables\Columns\TextColumn::make('order_source')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.order_source')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->badge()
                    ->color('info')
                    ->label(__('models.currency_symbol'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->label(__('models.subtotal'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label(__('models.total'))
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
                SelectFilter::make('order_status')
                    ->label(__('models.status'))
                    ->options([
                        collect(OrderStatus::cases())
                            ->mapWithKeys(fn(OrderStatus $status) => [$status->value => $status->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),
                SelectFilter::make('order_source')
                    ->label(__('models.order_source'))
                    ->options([
                        ['' => __('Todos')] +
                        collect(OrderSource::cases())
                            ->mapWithKeys(fn(OrderSource $source) => [$source->value => $source->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),

                Filter::make('date_applied')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('models.start_date')),
                        DatePicker::make('created_until')
                            ->label(__('models.end_date')),
    				])
                    ->query(function (Builder $query, array $data): Builder {
        				return $query
            				->when(
                				$data['created_from'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
    				}),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.orders');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.orders');
    }
}

