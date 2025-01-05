<?php

namespace App\Filament\Resources\Reservations;

use App\Enums\CurrencySymbol;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;
use App\Filament\Resources\Reservations\ReservationPaymentResource\RelationManagers;
use App\Models\Reservations\ReservationPayment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\Filter;
use Filament\Tables\FIlters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationPaymentResource extends Resource
{
    protected static ?string $model = ReservationPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function getBreadcrumb(): string
    {
        return __('models.payments');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('created_at', now()->toDateString())->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('reservation_id')
                            ->relationship('reservation', 'reservation_code')
                            ->label(__('models.reservation'))
                            ->required(),
                        TextInput::make('payment_code')
                            ->label(__('models.payment_code'))
                            ->default('PE-' . random_int(1000000, 888888888))
                            ->disabled()
                            ->dehydrated(),
                        Select::make('payment_method')
                            ->options(PaymentMethod::class)
                            ->searchable()
                            ->default('Cash')
                            ->required()
                            ->label(__('models.payment_method')),
                        Select::make('payment_status')
                            ->options(PaymentStatus::class)
                            ->searchable()
                            ->default('Pending')
                            ->required()
                            ->label(__('models.payment_status')),
                    ]),
                    Section::make([
                        Select::make('currency_symbol')
                            ->options(CurrencySymbol::class)
                            ->searchable()
                            ->default('USD $')
                            ->required()
                            ->label(__('models.currency_symbol')),
                        TextInput::make('payment_amount')
                            ->required()
                            ->label(__('models.payment_amount'))
                            ->numeric()
                            ->default(0),
                    ]),
                ])
                    ->columnSpanFull()
                    ->from('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reservation.reservation_code')
                    ->numeric()
                    ->label(__('models.reservation'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->badge()
                    ->formatStateUsing(fn ($record) => PaymentMethod::from($record->payment_method)->getLabel())
                    ->color('info')
                    ->searchable()
                    ->label(__('models.payment_method')),
                TextColumn::make('currency_symbol')
                    ->badge()
                    ->searchable()
                    ->color('success')
                    ->label(__('models.currency_symbol')),
                TextColumn::make('payment_amount')
                    ->numeric()
                    ->label(__('models.payment_amount'))
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label(__('models.payment_status'))
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(fn ($record) => PaymentStatus::from($record->payment_status)->getLabel()),
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
                Filter::make('created_at')
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
