<?php

namespace App\Filament\Resources\Recipes\IngredientResource\Pages;

use App\Filament\Resources\Recipes\IngredientResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIngredients extends ListRecords
{
    protected static string $resource = IngredientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_ingredient')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.ingredients');
    }
}
