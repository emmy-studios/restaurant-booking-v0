<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\ProductResource\Pages;
use App\Filament\Resources\Products\ProductResource\RelationManagers;
use App\Filament\Resources\Products\ProductResource\RelationManagers\CategoriesRelationManager;
use App\Models\Products\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label(__('models.name'))
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->label(__('models.quantity')) 
                    ->numeric(), 
                Forms\Components\TextInput::make('portion')
                    ->required()
                    ->label(__('models.portion'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->label(__('models.description'))
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->disk('public')
                    ->directory('product-images')
                    ->image()
                    ->imageEditor()
                    ->label(__('models.image_url')) 
                    ->required(),
            ]);
    } 

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('models.name'))
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->circular()
                    ->label(__('models.image_url')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('models.quantity')),
                Tables\Columns\TextColumn::make('portion')
                    ->searchable()
                    ->label(__('models.portion')),
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
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.products');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.products');
    }
}
 