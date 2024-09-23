<?php

namespace App\Filament\Resources\Inventories\InventoryAuditResource\Pages;

use App\Filament\Resources\Inventories\InventoryAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventoryAudit extends CreateRecord
{
    protected static string $resource = InventoryAuditResource::class;

    public function getTitle(): string
    {
        return __('models.create_audit');
    }
} 
