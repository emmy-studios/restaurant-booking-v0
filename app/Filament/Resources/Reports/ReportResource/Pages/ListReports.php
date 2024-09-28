<?php

namespace App\Filament\Resources\Reports\ReportResource\Pages;

use App\Filament\Resources\Reports\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_report')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.reports');
    } 
}
 