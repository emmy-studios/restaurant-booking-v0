<?php

namespace App\Filament\Resources\Menus\MenuPriceResource\Pages;

use App\Filament\Resources\Menus\MenuPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuPrice extends CreateRecord
{
    protected static string $resource = MenuPriceResource::class;

    public function getTitle(): string
    {
        return __('models.create_menu_price');
    }
}
 