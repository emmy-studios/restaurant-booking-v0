<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;
use App\Filament\Resources\Orders\OrderCancellationRequestResource\RelationManagers;
use App\Models\Orders\OrderCancellationRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\OrderCancellationStatus;

class OrderCancellationRequestResource extends Resource
{
    protected static ?string $model = OrderCancellationRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->required()
                    ->label(__('models.order_code'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('reason')
                    ->columnSpanFull()
                    ->label(__('models.reason')),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
                Forms\Components\Select::make('status')
                    ->options(OrderCancellationStatus::class)
                    ->searchable()
                    ->default('Processing')
                    ->label(__('models.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->label(__('models.order_code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('models.status')),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderCancellationRequests::route('/'),
            'create' => Pages\CreateOrderCancellationRequest::route('/create'),
            'view' => Pages\ViewOrderCancellationRequest::route('/{record}'),
            'edit' => Pages\EditOrderCancellationRequest::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.cancellation_request');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.orders');
    }

}
