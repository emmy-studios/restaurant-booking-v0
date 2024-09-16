<?php

namespace App\Filament\Resources\Recipes\RecipeResource\Pages;

use App\Filament\Resources\Recipes\RecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecipe extends EditRecord
{
    protected static string $resource = RecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.edit_recipe');
    }
}
