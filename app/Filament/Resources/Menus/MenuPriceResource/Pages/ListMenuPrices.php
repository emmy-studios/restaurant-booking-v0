<?php

namespace App\Filament\Resources\Menus\MenuPriceResource\Pages;

use App\Filament\Resources\Menus\MenuPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuPrices extends ListRecords
{
    protected static string $resource = MenuPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_menu_price')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.menu_prices');
    } 
}
 