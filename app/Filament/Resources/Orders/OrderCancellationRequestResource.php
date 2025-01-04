<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;
use App\Filament\Resources\Orders\OrderCancellationRequestResource\RelationManagers;
use App\Models\Orders\OrderCancellationRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\OrderCancellationStatus;

class OrderCancellationRequestResource extends Resource
{
    protected static ?string $model = OrderCancellationRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Processing')->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label(__('models.user'))
                        ->required(),
                    TextInput::make('order_code')
                        ->required()
                        ->label(__('models.order_code'))
                        ->maxLength(255),
                    Select::make('status')
                        ->options(OrderCancellationStatus::class)
                        ->searchable()
                        ->default('Processing')
                        ->label(__('models.status')),
                ])->columns(2),
                Section::make([
                    MarkdownEditor::make('reason')
                        ->columnSpanFull()
                        ->label(__('models.reason')),
                    MarkdownEditor::make('additional_details')
                        ->columnSpanFull()
                        ->label(__('models.additional_details'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('models.user'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('order_code')
                    ->label(__('models.order_code'))
                    ->searchable(),
                TextColumn::make('status')
                    ->label(__('models.status')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable(),
                TextColumn::make('updated_at')
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
                ])
                    ->tooltip(__('panels.actions'))
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
