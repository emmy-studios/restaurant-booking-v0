<?php

namespace App\Filament\Resources\Recipes\IngredientResource\Pages;

use App\Filament\Resources\Recipes\IngredientResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIngredient extends ViewRecord
{
    protected static string $resource = IngredientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_ingredient');
    }
} 
