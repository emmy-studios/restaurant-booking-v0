<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\EventStatus;
use App\Filament\Resources\Events\EventResource\Pages;
use App\Filament\Resources\Events\EventResource\RelationManagers;
use App\Filament\Resources\Events\EventResource\RelationManagers\StaffRelationManager;
use App\Filament\Resources\Events\EventResource\RelationManagers\TablesRelationManager;
use App\Filament\Resources\Events\EventResource\RelationManagers\EventPackagesRelationManager;
use App\Models\Events\Event;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('models.events');
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
                        TextInput::make('event_code')
                            ->default('EV-' . random_int(100000, 9999999999))
                            ->required()
                            ->label(__('models.event_code'))
                            ->maxLength(255),
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label(__('models.user'))
                            ->required(),
                        DateTimePicker::make('event_date')
                            ->label(__('models.event_date')),
                        TextInput::make('number_of_guests')
                            ->required()
                            ->label(__('models.number_of_guests'))
                            ->numeric()
                            ->default(1),
                        Select::make('event_status')
                            ->options(EventStatus::class)
                            ->searchable()
                            ->default('Confirmed')
                            ->required()
                            ->label(__('models.event_status'))
                    ]),
                    Section::make([
                        Select::make('currency_symbol')
                            ->options(CurrencySymbol::class)
                            ->searchable()
                            ->default('USD $')
                            ->required()
                            ->label(__('models.currency_symbol')),
                        TextInput::make('subtotal_cost')
                            ->required()
                            ->label(__('models.subtotal_cost'))
                            ->numeric()
                            ->default(0),
                        TextInput::make('total_cost')
                            ->required()
                            ->default(0)
                            ->label(__('models.total_cost'))
                            ->numeric(),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    TextInput::make('event_name')
                        ->required()
                        ->label(__('models.event_name'))
                        ->maxLength(255),
                    MarkdownEditor::make('event_description')
                        ->columnSpanFull()
                        ->label(__('models.event_description')),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event_code')
                    ->searchable()
                    ->label(__('models.event_code')),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('models.user'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_name')
                    ->searchable()
                    ->label(__('models.event_name'))
                     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('event_date')
                    ->dateTime()
                    ->searchable()
                    ->label(__('models.event_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_guests')
                    ->numeric()
                    ->label(__('models.number_of_guests'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('event_status')
                    ->label(__('models.event_status'))
                    ->badge()
                    ->formatStateUsing(fn ($record) => EventStatus::from($record->event_status)->getLabel())
                    ->color(fn ($record) => EventStatus::from($record->event_status)->getColor())
                    ->icon(fn ($record) => EventStatus::from($record->event_status)->getIcon())
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol'))
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subtotal_cost')
                    ->numeric()
                    ->label(__('models.subtotal_cost'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_cost')
                    ->numeric()
                    ->label(__('models.total_cost'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Filter::make('event_date')
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
                				fn (Builder $query, $date): Builder => $query->whereDate('event_date', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('event_date', '<=', $date),
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
            StaffRelationManager::class,
            TablesRelationManager::class,
            EventPackagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.events');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.events');
    }
}
