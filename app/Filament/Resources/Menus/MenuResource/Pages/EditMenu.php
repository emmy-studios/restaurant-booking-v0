<?php

namespace App\Filament\Resources\Menus\MenuResource\Pages;

use App\Filament\Resources\Menus\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(), 
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_menu');
    }
}
