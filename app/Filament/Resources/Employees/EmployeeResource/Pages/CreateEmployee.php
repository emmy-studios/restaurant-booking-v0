<?php

namespace App\Filament\Resources\Employees\EmployeeResource\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    public function getTitle(): string
    {
        return __('models.create_employee');
    }

}
