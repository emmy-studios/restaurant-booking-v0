<?php

namespace App\Filament\Resources\Recipes;

use App\Filament\Resources\Recipes\RecipeResource\Pages;
use App\Filament\Resources\Recipes\RecipeResource\RelationManagers;
use App\Models\Recipes\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{ 
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\MarkdownEditor::make('title')
                    ->label(__('models.title'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('preparation')
                    ->columnSpanFull()
                    ->label(__('models.preparation')),
                Forms\Components\MarkdownEditor::make('recomendations')
                    ->columnSpanFull()
                    ->label(__('models.recomendations')),
                Forms\Components\MarkdownEditor::make('considerations')
                    ->columnSpanFull()
                    ->label(__('models.considerations')),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->columnSpanFull()
                    ->label(__('models.additional_details')),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label(__('models.product'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->label(__('models.product'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
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
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'view' => Pages\ViewRecipe::route('/{record}'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.recipes');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.recipes'); 
    }
}
