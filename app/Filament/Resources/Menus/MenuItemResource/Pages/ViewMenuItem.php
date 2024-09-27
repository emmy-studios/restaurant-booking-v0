<?php

namespace App\Filament\Resources\Menus\MenuItemResource\Pages;

use App\Filament\Resources\Menus\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenuItem extends ViewRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_item');
    }
}
