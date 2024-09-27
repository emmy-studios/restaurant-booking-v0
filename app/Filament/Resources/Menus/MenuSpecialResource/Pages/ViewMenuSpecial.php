<?php

namespace App\Filament\Resources\Menus\MenuSpecialResource\Pages;

use App\Filament\Resources\Menus\MenuSpecialResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenuSpecial extends ViewRecord
{
    protected static string $resource = MenuSpecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_menu_special');
    }
}
 