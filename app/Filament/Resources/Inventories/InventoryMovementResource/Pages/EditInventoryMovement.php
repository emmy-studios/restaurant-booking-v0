<?php

namespace App\Filament\Resources\Inventories\InventoryMovementResource\Pages;

use App\Filament\Resources\Inventories\InventoryMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryMovement extends EditRecord
{
    protected static string $resource = InventoryMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(), 
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_movement');
    }
}
