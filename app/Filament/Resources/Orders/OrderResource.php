<?php

namespace App\Filament\Resources\Orders;

use App\Enums\OrderSource;
use App\Enums\OrderStatus;
use App\Enums\PaymentCurrency;
use App\Filament\Resources\Orders\OrderResource\Pages;
use App\Filament\Resources\Orders\OrderResource\RelationManagers;
use App\Models\Orders\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                    ->relationship('user', 'id') 
                    ->label(__('models.user'))
                    ->required(),
                Forms\Components\Select::make('order_status') 
                    ->options(self::getOrderStatus())
                    ->searchable()
                    ->default('Processing')
                    ->label(__('models.order_status')),
                Forms\Components\Select::make('order_currency')
                    ->options(self::getPaymentCurrency())
                    ->searchable()
                    ->required()
                    ->default('USD')
                    ->label(__('models.order_currency')),
                Forms\Components\Select::make('order_source')
                    ->options(self::getOrderSource())
                    ->default('Online')
                    ->searchable()
                    ->label(__('models.order_source')),
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
                Tables\Columns\TextColumn::make('user.id')
                    ->numeric()
                    ->label(__('models.user')) 
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->label(__('models.order_status')),
                Tables\Columns\TextColumn::make('order_currency')
                    ->searchable()
                    ->label(__('models.order_currency')),
                Tables\Columns\TextColumn::make('order_source')
                    ->label(__('models.order_source')),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    //
    public static function getOrderSource(): array
    {
        return array_map(fn($case) => $case->value, OrderSource::cases());
    }

    public static function getOrderStatus(): array
    {
        return array_map(fn($case) => $case->value, OrderStatus::cases());
    }

    public static function getPaymentCurrency(): array
    {
        return array_map(fn($case) => $case->value, PaymentCurrency::cases());
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
