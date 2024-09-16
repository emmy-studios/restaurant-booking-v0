<?php

namespace App\Filament\Resources\Menus\MenuResource\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_menu')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.menus');
    }
}
