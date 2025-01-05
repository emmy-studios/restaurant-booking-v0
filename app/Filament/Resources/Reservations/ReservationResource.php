<?php

namespace App\Filament\Resources\Reservations;

use App\Enums\ReservationStatus;
use App\Filament\Resources\Reservations\ReservationResource\Pages;
use App\Filament\Resources\Reservations\ReservationResource\RelationManagers;
use App\FIlament\Resources\Reservations\ReservationResource\RelationManagers\TablesRelationManager;
use App\Models\Reservations\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('models.reservations');
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
                        TextInput::make('reservation_code')
                            ->label(__('reservation_code'))
                            ->default('RE-' . random_int(1000000, 999999999))
                            ->required(),
                        DateTimePicker::make('reservation_date')
                            ->required()
                            ->label(__('models.reservation_date')),
                        TextInput::make('number_of_guests')
                            ->numeric()
                            ->label(__('models.number_of_guests')),
                    ]),
                    Section::make([
                        Select::make('status')
                            ->options(ReservationStatus::class)
                            ->searchable()
                            ->default('Confirmed')
                            ->required()
                            ->label(__('models.status')),
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label(__('models.customer')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('special_requests')
                        ->columnSpanFull()
                        ->label(__('models.special_requests'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reservation_code')
                    ->label(__('models.reservation_code'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reservation_date')
                    ->dateTime()
                    ->label(__('models.reservation_date'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('number_of_guests')
                    ->numeric()
                    ->label(__('models.number_of_guests'))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($record) => ReservationStatus::from($record->status)->getLabel())
                    ->color(fn ($record) => ReservationStatus::from($record->status)->getColor())
                    ->icon(fn ($record) => ReservationStatus::from($record->status)->getIcon())
                    ->searchable()
                    ->label(__('models.status')),
                TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.customer'))
                    ->sortable()
                    ->searchable(),
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
                SelectFilter::make('status')
                    ->label(__('models.status'))
                    ->options([
                        collect(ReservationStatus::cases())
                            ->mapWithKeys(fn(ReservationStatus $status) => [$status->value => $status->getLabel()])
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
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getReservationStatus(): array
    {
        return array_map(fn($case) => $case->value, ReservationStatus::cases());
    }

    public static function getRelations(): array
    {
        return [
            TablesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'view' => Pages\ViewReservation::route('/{record}'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.reservations');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.reservations');
    }
}
