<?php

namespace App\Filament\Resources\Reports\InventoryReportResource\Pages;

use App\Filament\Resources\Reports\InventoryReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryReports extends ListRecords
{
    protected static string $resource = InventoryReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
