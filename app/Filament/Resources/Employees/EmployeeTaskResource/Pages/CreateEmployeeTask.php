<?php

namespace App\Filament\Resources\Employees\EmployeeTaskResource\Pages;

use App\Filament\Resources\Employees\EmployeeTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployeeTask extends CreateRecord
{
    protected static string $resource = EmployeeTaskResource::class;
}
