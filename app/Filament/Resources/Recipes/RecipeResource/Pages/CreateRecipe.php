<?php

namespace App\Filament\Resources\Recipes\RecipeResource\Pages;

use App\Filament\Resources\Recipes\RecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRecipe extends CreateRecord
{
    protected static string $resource = RecipeResource::class;

    public function getTitle(): string
    {
        return __('models.create_recipe');
    }
}
 