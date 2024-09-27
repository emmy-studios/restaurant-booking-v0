<?php

namespace App\Filament\Resources\Menus\MenuPriceResource\Pages;

use App\Filament\Resources\Menus\MenuPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenuPrice extends ViewRecord
{
    protected static string $resource = MenuPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_menu_price');
    }
} 
