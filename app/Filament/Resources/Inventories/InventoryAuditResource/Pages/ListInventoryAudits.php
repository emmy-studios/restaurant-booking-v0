<?php

namespace App\Filament\Resources\Inventories\InventoryAuditResource\Pages;

use App\Filament\Resources\Inventories\InventoryAuditResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryAudits extends ListRecords
{
    protected static string $resource = InventoryAuditResource::class;

    protected function getHeaderActions(): array
    { 
        return [
            Actions\CreateAction::make()->label(__('models.create_audit')),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.audits');
    }
}
