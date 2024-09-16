<?php

namespace App\Filament\Resources\Menus\MenuSpecialResource\Pages;

use App\Filament\Resources\Menus\MenuSpecialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuSpecial extends EditRecord
{
    protected static string $resource = MenuSpecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
