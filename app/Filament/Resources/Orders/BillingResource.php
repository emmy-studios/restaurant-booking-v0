<?php

namespace App\Filament\Resources\Orders;

use App\Enums\BillingStatus;
use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Filament\Resources\Orders\BillingResource\Pages;
use App\Filament\Resources\Orders\BillingResource\RelationManagers;
use App\Models\Orders\Billing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;
 
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form 
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label(__('models.name'))
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('order_id')
                    ->relationship('order', 'id')
                    ->label(__('models.order'))
                    ->required(),
                Forms\Components\TextInput::make('billing_code')
                    ->required()
                    ->label(__('models.billing_code'))
                    ->maxLength(255),
                Forms\Components\Select::make('payment_method')
                    ->options(self::getPaymentMethod())
                    ->searchable()
                    ->default('Credit Card')
                    ->label(__('models.payment_method')),
                Forms\Components\Select::make('payment_currency')
                    ->options(self::getCurrencyCode())
                    ->searchable()
                    ->default('USD $')
                    ->required()
                    ->label(__('models.payment_currency')),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(self::getBillingStatus())
                    ->default('Processing')
                    ->searchable()
                    ->label(__('models.status')),
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('models.name'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order.id')
                    ->numeric()
                    ->label(__('models.order'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('billing_code')
                    ->searchable()
                    ->label(__('models.billing_code')),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('models.payment_method')),
                Tables\Columns\TextColumn::make('payment_currency')
                    ->label(__('models.payment_currency')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('models.status')),
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
            'index' => Pages\ListBillings::route('/'),
            'create' => Pages\CreateBilling::route('/create'),
            'view' => Pages\ViewBilling::route('/{record}'),
            'edit' => Pages\EditBilling::route('/{record}/edit'),
        ];
    }

    // Get Enums Values
    public static function getPaymentMethod(): array
    {
        return array_map(fn($case) => $case->value, PaymentMethod::cases());
    }

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
    }

    public static function getBillingStatus(): array
    {
        return array_map(fn($case) => $case->value, BillingStatus::cases());
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.billings');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.orders');
    }
}
