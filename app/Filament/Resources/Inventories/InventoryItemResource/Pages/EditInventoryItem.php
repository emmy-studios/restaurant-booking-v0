<?php

namespace App\Filament\Resources\Inventories\InventoryItemResource\Pages;

use App\Filament\Resources\Inventories\InventoryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryItem extends EditRecord
{
    protected static string $resource = InventoryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(), 
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_item');
    }
}
