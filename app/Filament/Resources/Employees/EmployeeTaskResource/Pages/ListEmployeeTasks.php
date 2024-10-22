<?php

namespace App\Filament\Resources\Employees\EmployeeTaskResource\Pages;

use App\Filament\Resources\Employees\EmployeeTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeTasks extends ListRecords
{
    protected static string $resource = EmployeeTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
