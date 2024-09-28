<?php

namespace App\Filament\Resources\Reports\DailySaleReportResource\Pages;

use App\Filament\Resources\Reports\DailySaleReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDailySaleReport extends ViewRecord
{
    protected static string $resource = DailySaleReportResource::class;

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
