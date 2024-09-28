<?php

namespace App\Filament\Resources\Reports\InventoryReportResource\Pages;

use App\Filament\Resources\Reports\InventoryReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInventoryReport extends ViewRecord
{
    protected static string $resource = InventoryReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_report');
    }
} 
