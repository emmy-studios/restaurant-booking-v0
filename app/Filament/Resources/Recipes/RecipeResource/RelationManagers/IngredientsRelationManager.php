<?php

namespace App\Filament\Resources\Recipes\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class IngredientsRelationManager extends RelationManager
{
    protected static string $relationship = 'ingredients';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('models.ingredients_of_the_recipe');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('models.name')),
                Tables\Columns\ImageColumn::make('image_url')
                    ->circular()
                    ->label(__('models.image_url')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->multiple()
                    ->recordSelect(fn (Select $select) => $select->placeholder(__('models.select_ingredient/ingredients')))
                    ->modalHeading(__('models.attach_ingredient')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->modalHeading(__('models.details'))
                        ->label(__('models.view_table'))
                        ->form([
                            Split::make([
                                Section::make([
                                    TextInput::make('name')
                                        ->label(__('models.name'))
                                        ->disabled(),
                                ]),
                                Section::make([
                                    MarkdownEditor::make('description')
                                        ->label(__('models.description'))
                                        ->disabled(),
                                ]),
                            ]),
                        ]),
                    Tables\Actions\DetachAction::make()
                ])->tooltip(__('panels.actions'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
