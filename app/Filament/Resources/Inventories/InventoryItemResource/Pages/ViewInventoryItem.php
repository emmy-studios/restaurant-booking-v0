<?php

namespace App\Filament\Resources\Inventories\InventoryItemResource\Pages;

use App\Filament\Resources\Inventories\InventoryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInventoryItem extends ViewRecord
{
    protected static string $resource = InventoryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
