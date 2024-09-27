<?php

namespace App\Filament\Resources\Inventories\InventoryResource\Pages;

use App\Filament\Resources\Inventories\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventories extends ListRecords
{
    protected static string $resource = InventoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_inventory')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.inventories');
    } 
}
