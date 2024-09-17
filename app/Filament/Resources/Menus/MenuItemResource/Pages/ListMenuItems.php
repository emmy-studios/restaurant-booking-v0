<?php

namespace App\Filament\Resources\Menus\MenuItemResource\Pages;

use App\Filament\Resources\Menus\MenuItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_menu_item')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.menu_items');
    }
} 
