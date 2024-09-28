<?php

namespace App\Filament\Resources\Purchases;

use App\Filament\Resources\Purchases\PurchaseResource\Pages;
use App\Filament\Resources\Purchases\PurchaseResource\RelationManagers;
use App\Models\Purchases\Purchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';
 
    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->label(__('models.supplier'))
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->label(__('models.total_amount'))
                    ->numeric(),
                Forms\Components\DateTimePicker::make('purchase_datetime')
                    ->label(__('models.purchase_datetime')),
                Forms\Components\TextInput::make('purchase_supervisor')
                    ->maxLength(255)
                    ->label(__('models.purchase_supervisor')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')
                    ->numeric()
                    ->label(__('models.supplier'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->label(__('models.total_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_datetime')
                    ->dateTime()
                    ->label(__('models.purchase_datetime'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_supervisor')
                    ->searchable()
                    ->label(__('models.purchase_supervisor')),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'view' => Pages\ViewPurchase::route('/{record}'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.purchases');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.purchases');
    }
}
