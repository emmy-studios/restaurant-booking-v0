<?php

namespace App\Filament\Resources\Menus\MenuResource\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenu extends ViewRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    } 

    public function getTitle(): string 
    {
        return __('models.view_menu');
    }
}
