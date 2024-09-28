<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Enums\EventStatus;
use App\Filament\Resources\Events\EventResource\Pages;
use App\Filament\Resources\Events\EventResource\RelationManagers;
use App\Models\Events\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form 
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('event_code')
                    ->required()
                    ->label(__('models.event_code'))
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.user'))
                    ->required(),
                Forms\Components\TextInput::make('event_name')
                    ->required()
                    ->label(__('models.event_name'))
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('event_date')
                    ->label(__('models.event_date')),
                Forms\Components\TextInput::make('number_of_guests')
                    ->required()
                    ->label(__('models.number_of_guests'))
                    ->numeric(),
                Forms\Components\MarkdownEditor::make('event_description')
                    ->columnSpanFull()
                    ->label(__('models.event_description')),
                Forms\Components\Select::make('event_status')
                    ->options(self::getEventStatus())
                    ->searchable()
                    ->default('Confirmed')
                    ->required()
                    ->label(__('models.event_status')),
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
                Forms\Components\TextInput::make('subtotal_cost')
                    ->required()
                    ->label(__('models.subtotal_cost'))
                    ->numeric(),
                Forms\Components\TextInput::make('total_cost')
                    ->required()
                    ->label(__('models.total_cost'))
                    ->numeric(),
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
                    ->numeric()
                    ->label(__('models.user'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_name')
                    ->searchable()
                    ->label(__('models.event_name')),
                Tables\Columns\TextColumn::make('event_date')
                    ->dateTime()
                    ->label(__('models.event_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_guests')
                    ->numeric()
                    ->label(__('models.number_of_guests'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('event_status')
                    ->label(__('models.event_status')),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('subtotal_cost')
                    ->numeric()
                    ->label(__('models.subtotal_cost'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_cost')
                    ->numeric()
                    ->label(__('models.total_cost'))
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

    public static function getEventStatus(): array
    {
        return array_map(fn($case) => $case->value, EventStatus::cases());
    }
 
    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
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
