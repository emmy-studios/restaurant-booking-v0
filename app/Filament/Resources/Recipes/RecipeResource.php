<?php

namespace App\Filament\Resources\Recipes;

use App\Filament\Resources\Recipes\RecipeResource\Pages;
use App\Filament\Resources\Recipes\RecipeResource\RelationManagers;
use App\Filament\Resources\Recipes\RecipeResource\RelationManagers\IngredientsRelationManager;
use App\Models\Recipes\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    public static function getBreadcrumb(): string
    {
        return __('models.recipes');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        MarkdownEditor::make('title')
                            ->label(__('models.title'))
                            ->required()
                            ->columnSpanFull()
                    ]),
                    Section::make([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->label(__('models.product'))
                            ->required()
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make([
                    MarkdownEditor::make('preparation')
                        ->columnSpanFull()
                        ->label(__('models.preparation'))
                ]),
                Section::make([
                    MarkdownEditor::make('recomendations')
                        ->columnSpanFull()
                        ->label(__('models.recomendations')),
                    MarkdownEditor::make('considerations')
                        ->columnSpanFull()
                        ->label(__('models.considerations')),
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
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->searchable()
                    ->label(__('models.product'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('models.title'))
                    ->words(15)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('preparation')
                    ->label(__('models.preparation'))
                    ->limit(15)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('models.updated_at'))
                    ->dateTime()
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
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
            IngredientsRelationManager::class,
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
