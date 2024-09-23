<?php

namespace App\Filament\Resources\Inventories\InventoryAuditResource\Pages;

use App\Filament\Resources\Inventories\InventoryAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryAudit extends EditRecord
{
    protected static string $resource = InventoryAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.edit_audit');
    }
}

