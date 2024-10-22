<?php

namespace App\Filament\Resources\Employees\EmployeeTaskResource\Pages;

use App\Filament\Resources\Employees\EmployeeTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeTask extends ViewRecord
{
    protected static string $resource = EmployeeTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
