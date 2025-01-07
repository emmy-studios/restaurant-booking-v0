<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Events\EventServiceResource\Pages;
use App\Filament\Resources\Events\EventServiceResource\RelationManagers;
use App\Models\Events\EventService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventServiceResource extends Resource
{
    protected static ?string $model = EventService::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function getBreadcrumb(): string
    {
        return __('models.event_services');
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
                        TextInput::make('name')
                            ->required()
                            ->label(__('models.name'))
                            ->maxLength(255),
                    ]),
                    Section::make([
                        Select::make('currency_symbol')
                            ->options(CurrencySymbol::class)
                            ->searchable()
                            ->default('USD $')
                            ->required()
                            ->label(__('models.currency_code')),
                        TextInput::make('service_price')
                            ->numeric()
                            ->default(0)
                            ->label(__('models.service_price')),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->label(__('models.description')),
                    MarkdownEditor::make('details')
                        ->columnSpanFull()
                        ->label(__('models.details')),
                    MarkdownEditor::make('additional_details')
                        ->columnSpanFull()
                        ->label(__('models.additional_details')),
                    TextInput::make('additional_cost')
                        ->numeric()
                        ->default(0)
                        ->label(__('models.additional_cost')),
                    MarkdownEditor::make('additional_cost_details')
                        ->columnSpanFull()
                        ->label(__('models.additional_cost_details'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.event_code')
                    ->numeric()
                    ->label(__('models.event'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol'))
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('service_price')
                    ->numeric()
                    ->label(__('models.service_price'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('additional_cost')
                    ->numeric()
                    ->label(__('models.additional_cost'))
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
                //
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
            'index' => Pages\ListEventServices::route('/'),
            'create' => Pages\CreateEventService::route('/create'),
            'view' => Pages\ViewEventService::route('/{record}'),
            'edit' => Pages\EditEventService::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.event_services');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.events');
    }
}
