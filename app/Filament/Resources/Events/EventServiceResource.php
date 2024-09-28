<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Events\EventServiceResource\Pages;
use App\Filament\Resources\Events\EventServiceResource\RelationManagers;
use App\Models\Events\EventService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventServiceResource extends Resource
{
    protected static ?string $model = EventService::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form 
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->relationship('event', 'id')
                    ->label(__('models.event'))
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(__('models.name'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\MarkdownEditor::make('details')
                    ->columnSpanFull()
                    ->label(__('models.details')), 
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
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
                    ->label(__('models.currency_code')),
                Forms\Components\TextInput::make('service_price')
                    ->numeric()
                    ->label(__('models.service_price')),
                Forms\Components\TextInput::make('additional_cost')
                    ->numeric()
                    ->label(__('models.additional_cost')),
                Forms\Components\MarkdownEditor::make('additional_cost_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_cost_details')),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name')),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('service_price')
                    ->numeric()
                    ->label(__('models.service_price'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('additional_cost')
                    ->numeric()
                    ->label(__('models.additional_cost'))
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

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
    }

    public static function getCurrencySymbol(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
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
