<?php

namespace App\Filament\Resources\Inventories\InventoryMovementResource\Pages;

use App\Filament\Resources\Inventories\InventoryMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventoryMovement extends CreateRecord
{
    protected static string $resource = InventoryMovementResource::class;

    public function getTitle(): string
    {
        return __('models.create_movement');
    } 
}
 