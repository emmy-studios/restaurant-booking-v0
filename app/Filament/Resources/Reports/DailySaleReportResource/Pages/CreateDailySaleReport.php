<?php

namespace App\Filament\Resources\Reports\DailySaleReportResource\Pages;

use App\Filament\Resources\Reports\DailySaleReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDailySaleReport extends CreateRecord
{
    protected static string $resource = DailySaleReportResource::class;

    public function getTitle(): string
    {
        return __('models.create_report');
    }
}
