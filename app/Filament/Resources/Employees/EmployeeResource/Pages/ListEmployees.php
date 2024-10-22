<?php

namespace App\Filament\Resources\Employees\EmployeeResource\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_employee')),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.employees');
    }
 
}
