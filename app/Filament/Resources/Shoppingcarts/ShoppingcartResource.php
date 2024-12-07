<?php

namespace App\Filament\Resources\Shoppingcarts;

use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\Pages;
use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\RelationManagers;
use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\RelationManagers\ProductsRelationManager;
use App\Models\Shoppingcarts\Shoppingcart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShoppingcartResource extends Resource
{
    protected static ?string $model = Shoppingcart::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.user'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.username'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable(),
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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShoppingcarts::route('/'),
            'create' => Pages\CreateShoppingcart::route('/create'),
            'view' => Pages\ViewShoppingcart::route('/{record}'),
            'edit' => Pages\EditShoppingcart::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.shoppingcarts');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.shoppingcarts');
    }

}
