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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventPaymentResource extends Resource
{
    protected static ?string $model = EventPayment::class;

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
                        Select::make('event_id')
                            ->relationship('event', 'event_code')
                            ->label(__('models.event'))
                            ->required(),
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
                            ->default(0)
                            ->numeric(),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.event_code')
                    ->numeric()
                    ->label(__('models.event'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->formatStateUsing(fn ($record) => PaymentMethod::from($record->payment_method)->getLabel())
                    ->color('info')
                    ->searchable()
                    ->label(__('models.payment_method')),
                Tables\Columns\TextColumn::make('payment_status')
                    ->formatStateUsing(fn ($record) => PaymentStatus::from($record->payment_status)->getLabel())
                    ->badge()
                    ->searchable()
                    ->color('warning')
                    ->label(__('models.payment_status')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol'))
                    ->badge()
                    ->searchable()
                    ->color('success'),
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
