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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('user_id')
                            ->label(__('models.name'))
                            ->relationship('user', 'name')
                            ->required(),
                        Select::make('order_id')
                            ->relationship('order', 'order_code')
                            ->label(__('models.order'))
                            ->required(),
                        TextInput::make('billing_code')
                            ->required()
                            ->default('BI-' . random_int(100000, 9999999))
                            ->disabled()
                            ->dehydrated()
                            ->label(__('models.billing_code'))
                            ->maxLength(255),
                        Select::make('payment_method')
                            ->options(PaymentMethod::class)
                            ->searchable()
                            ->default('Credit Card')
                            ->label(__('models.payment_method')),
                        Select::make('status')
                            ->required()
                            ->options(BillingStatus::class)
                            ->default('Processing')
                            ->searchable()
                            ->label(__('models.status')),
                    ]),
                    Section::make([
                        Select::make('currency_symbol')
                            ->options(CurrencySymbol::class)
                            ->searchable()
                            ->default('USD $')
                            ->required()
                            ->label(__('models.payment_currency')),
                        TextInput::make('subtotal')
                            ->required()
                            ->label(__('models.subtotal'))
                            ->numeric()
                            ->default(0),
                        TextInput::make('total')
                            ->required()
                            ->label(__('models.total'))
                            ->numeric()
                            ->default(0),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('models.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('order.order_code')
                    ->searchable()
                    ->label(__('models.order'))
                    ->sortable(),
                TextColumn::make('billing_code')
                    ->searchable()
                    ->label(__('models.billing_code')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn ($record) => BillingStatus::from($record->status)->getColor())
                    ->searchable()
                    ->label(__('models.status')),
                TextColumn::make('payment_method')
                    ->searchable()
                    ->badge()
                    ->label(__('models.payment_method')),
                TextColumn::make('currency_symbol')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->label(__('models.payment_currency'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('subtotal')
                    ->numeric()
                    ->label(__('models.subtotal'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total')
                    ->numeric()
                    ->label(__('models.total'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                    ->tooltip(__('panels.actions'))
            ], position: ActionsPosition::BeforeColumns)
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
