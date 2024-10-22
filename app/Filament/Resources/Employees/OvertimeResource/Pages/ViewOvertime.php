<?php

namespace App\Filament\Resources\Employees\OvertimeResource\Pages;

use App\Filament\Resources\Employees\OvertimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOvertime extends ViewRecord
{
    protected static string $resource = OvertimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_overtime');
    }
}
