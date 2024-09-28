<?php

namespace App\Filament\Resources\Reports\InventoryReportResource\Pages;

use App\Filament\Resources\Reports\InventoryReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryReport extends EditRecord
{
    protected static string $resource = InventoryReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
