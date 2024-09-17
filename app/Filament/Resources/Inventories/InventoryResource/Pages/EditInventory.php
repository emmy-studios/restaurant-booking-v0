<?php

namespace App\Filament\Resources\Inventories\InventoryResource\Pages;

use App\Filament\Resources\Inventories\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventory extends EditRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
