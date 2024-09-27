<?php

namespace App\Filament\Resources\Menus\MenuItemResource\Pages;

use App\Filament\Resources\Menus\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuItem extends CreateRecord
{
    protected static string $resource = MenuItemResource::class;

    public function getTitle(): string
    {
        return __('models.create_item');
    }
}
