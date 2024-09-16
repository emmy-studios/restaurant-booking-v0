<?php

namespace App\Filament\Resources\Recipes\RecipeResource\Pages;

use App\Filament\Resources\Recipes\RecipeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getHeaderActions(): array
    { 
        return [
            Actions\CreateAction::make()->label(__('models.create_recipe')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.recipes');
    }
}
