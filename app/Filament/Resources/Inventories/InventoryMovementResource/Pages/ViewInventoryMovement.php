<?php

namespace App\Filament\Resources\Inventories\InventoryMovementResource\Pages;

use App\Filament\Resources\Inventories\InventoryMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInventoryMovement extends ViewRecord
{
    protected static string $resource = InventoryMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    } 

    public function getTitle(): string 
    {
        return __('models.view_movement');
    }
}
