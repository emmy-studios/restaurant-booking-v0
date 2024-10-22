<?php

namespace App\Filament\Resources\Employees\AbsenceResource\Pages;

use App\Filament\Resources\Employees\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAbsence extends ViewRecord
{
    protected static string $resource = AbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_absence');
    }
}
