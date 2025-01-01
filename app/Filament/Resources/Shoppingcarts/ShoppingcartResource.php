<?php

namespace App\Filament\Resources\Shoppingcarts;

use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\Pages;
use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\RelationManagers;
use App\Filament\Resources\Shoppingcarts\ShoppingcartResource\RelationManagers\ProductsRelationManager;
use App\Models\Shoppingcarts\Shoppingcart;
use App\Models\Products\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShoppingcartResource extends Resource
{
    protected static ?string $model = Shoppingcart::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('customer')
                        ->label(__('models.customer'))
                        ->icon('heroicon-o-user-plus')
                        ->schema([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label(__('models.user'))
                                ->required(),
                        ]),
                    Wizard\Step::make('products')
                        ->label(__('models.products'))
                        ->icon('heroicon-o-folder-plus')
                        ->schema([
                            Select::make('products')
                                ->relationship('products', 'name')
                                ->label(__('models.product'))
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->required(),
                        ]),
                ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.username'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->sortable(),
                TextColumn::make('products_count')
                    ->counts('products')
                    ->label(__('models.products')),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
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
            //ProductsRelationManager::class,
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
