<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\ProductResource\Pages;
use App\Filament\Resources\Products\ProductResource\RelationManagers;
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
                    ->label(__('models.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->label(__('models.description'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_url')
                    ->label(__('models.image_url'))
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('portion')
                    ->label(__('models.portion'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit_price')
                    ->label(__('models.unit_price'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('models.name'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label(__('models.image_url')), 
                Tables\Columns\TextColumn::make('portion')
                    ->label(__('models.portion'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->label(__('models.unit_price'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('models.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('models.updated_at'))
                    ->dateTime()
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
