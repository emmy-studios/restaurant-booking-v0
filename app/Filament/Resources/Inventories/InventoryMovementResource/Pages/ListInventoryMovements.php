<?php

namespace App\Filament\Resources\Inventories\InventoryMovementResource\Pages;

use App\Filament\Resources\Inventories\InventoryMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryMovements extends ListRecords
{
    protected static string $resource = InventoryMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_movement')),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.movements');
    }
}
