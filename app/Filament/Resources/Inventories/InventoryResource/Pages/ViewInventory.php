<?php

namespace App\Filament\Resources\Inventories\InventoryResource\Pages;

use App\Filament\Resources\Inventories\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInventory extends ViewRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ]; 
    }

    public function getTitle(): string 
    {
        return __('models.view_inventory');
    }
}
