<?php

namespace App\Filament\Resources\Menus\MenuPriceResource\Pages;

use App\Filament\Resources\Menus\MenuPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuPrice extends EditRecord
{
    protected static string $resource = MenuPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.edit_menu_price');
    }
}
