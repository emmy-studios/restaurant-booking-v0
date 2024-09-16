<?php

namespace App\Filament\Resources\Menus\MenuResource\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;

    public function getTitle(): string 
    {
        return __('models.create_menu');
    }
}
