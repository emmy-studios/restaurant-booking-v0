<?php

namespace App\Filament\Resources\Reports\DailySaleReportResource\Pages;

use App\Filament\Resources\Reports\DailySaleReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailySaleReport extends EditRecord
{
    protected static string $resource = DailySaleReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_report');
    }
}
 