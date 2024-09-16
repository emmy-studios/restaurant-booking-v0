<?php

namespace App\Filament\Resources\Recipes\IngredientResource\Pages;

use App\Filament\Resources\Recipes\IngredientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIngredient extends CreateRecord
{
    protected static string $resource = IngredientResource::class;

    public function getTitle(): string
    {
        return __('models.create_ingredient');
    }
}
 