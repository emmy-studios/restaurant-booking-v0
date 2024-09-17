<?php

namespace App\Filament\Resources\Menus\MenuItemResource\Pages;

use App\Filament\Resources\Menus\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuItem extends EditRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(), 
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_menu_item');
    }
}
