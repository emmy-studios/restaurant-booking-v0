<?php

namespace App\Filament\Resources\Reservations;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;
use App\Filament\Resources\Reservations\ReservationPaymentResource\RelationManagers;
use App\Models\Reservations\ReservationPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationPaymentResource extends Resource
{
    protected static ?string $model = ReservationPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->label(__('models.reservation'))
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options(self::getPaymentMethod())
                    ->searchable()
                    ->default('Cash')
                    ->required()
                    ->label(__('models.payment_method')),
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
                Forms\Components\Select::make('payment_status')
                    ->options(self::getPaymentStatus())
                    ->searchable()
                    ->default('Processing')
                    ->required()
                    ->label(__('models.payment_status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reservation.id')
                    ->numeric()
                    ->label(__('models.reservation'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('models.payment_method')),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->numeric()
                    ->label(__('models.payment_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_status')
                ->label(__('models.payment_status')),
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
            'index' => Pages\ListReservationPayments::route('/'),
            'create' => Pages\CreateReservationPayment::route('/create'),
            'view' => Pages\ViewReservationPayment::route('/{record}'),
            'edit' => Pages\EditReservationPayment::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.reservation_payments');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.reservations');
    }
}
