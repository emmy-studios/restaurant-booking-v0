<?php

namespace App\Filament\Resources\Recipes\RecipeResource\Pages;

use App\Filament\Resources\Recipes\RecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRecipe extends ViewRecord
{
    protected static string $resource = RecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    } 

    public function getTitle(): string 
    {
        return __('models.view_recipe');
    }
}
