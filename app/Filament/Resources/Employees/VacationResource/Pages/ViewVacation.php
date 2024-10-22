<?php

namespace App\Filament\Resources\Employees\VacationResource\Pages;

use App\Filament\Resources\Employees\VacationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVacation extends ViewRecord
{
    protected static string $resource = VacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
