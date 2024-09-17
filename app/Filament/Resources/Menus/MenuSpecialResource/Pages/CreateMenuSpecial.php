<?php

namespace App\Filament\Resources\Menus\MenuSpecialResource\Pages;

use App\Filament\Resources\Menus\MenuSpecialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuSpecial extends CreateRecord
{
    protected static string $resource = MenuSpecialResource::class;

    public function getTitle(): string
    {
        return __('models.create_menu_special'); 
    }
}
 