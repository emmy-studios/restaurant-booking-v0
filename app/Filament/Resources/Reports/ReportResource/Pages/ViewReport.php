<?php

namespace App\Filament\Resources\Reports\ReportResource\Pages;

use App\Filament\Resources\Reports\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

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
