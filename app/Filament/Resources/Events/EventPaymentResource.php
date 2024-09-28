<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Events\EventPaymentResource\Pages;
use App\Filament\Resources\Events\EventPaymentResource\RelationManagers;
use App\Models\Events\EventPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventPaymentResource extends Resource
{
    protected static ?string $model = EventPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;
 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->relationship('event', 'id')
                    ->label(__('models.event'))
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options(self::getPaymentMethod())
                    ->searchable()
                    ->default('Cash')
                    ->required()
                    ->label(__('models.payment_method')),
                Forms\Components\Select::make('payment_status')
                    ->options(self::getPaymentStatus())
                    ->searchable()
                    ->default('Completed')
                    ->required()
                    ->label(__('models.payment_status')),
                Forms\Components\Select::make('currency_code')
                    ->options(self::getCurrencyCode())
                    ->searchable()
                    ->default('USD')
                    ->required()
                    ->label(__('models.currency_code')),
                Forms\Components\Select::make('currency_symbol')
                    ->options(self::getCurrencySymbol())
                    ->searchable()
                    ->default('USD $')    
                    ->required()
                    ->label(__('models.currency_symbol')),
                Forms\Components\TextInput::make('payment_amount')
                    ->required()
                    ->label(__('models.payment_amount'))
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.id')
                    ->numeric()
                    ->label(__('models.event'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('models.payment_method')),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label(__('models.payment_status')),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->numeric()
                    ->label(__('models.payment_amount'))
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

    public static function getCurrencySymbol(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
    }

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
    }

    public static function getPaymentMethod(): array
    {
        return array_map(fn($case) => $case->value, PaymentMethod::cases());
    }

    public static function getPaymentStatus(): array
    {
        return array_map(fn($case) => $case->value, PaymentStatus::cases());
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
            'index' => Pages\ListEventPayments::route('/'),
            'create' => Pages\CreateEventPayment::route('/create'),
            'view' => Pages\ViewEventPayment::route('/{record}'),
            'edit' => Pages\EditEventPayment::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.event_payments');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.events');
    }
}
