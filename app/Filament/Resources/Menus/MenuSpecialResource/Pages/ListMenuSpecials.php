<?php

namespace App\Filament\Resources\Menus\MenuSpecialResource\Pages;

use App\Filament\Resources\Menus\MenuSpecialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuSpecials extends ListRecords
{
    protected static string $resource = MenuSpecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_menu_special')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.menu_specials');
    }
} 
