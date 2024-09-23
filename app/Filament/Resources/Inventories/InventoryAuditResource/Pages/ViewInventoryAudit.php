<?php

namespace App\Filament\Resources\Inventories\InventoryAuditResource\Pages;

use App\Filament\Resources\Inventories\InventoryAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInventoryAudit extends ViewRecord
{
    protected static string $resource = InventoryAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_audit');
    }
} 
