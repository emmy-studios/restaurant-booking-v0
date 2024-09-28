<?php

namespace App\Filament\Resources\Reports\DailySaleReportResource\Pages;

use App\Filament\Resources\Reports\DailySaleReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailySaleReports extends ListRecords
{
    protected static string $resource = DailySaleReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
