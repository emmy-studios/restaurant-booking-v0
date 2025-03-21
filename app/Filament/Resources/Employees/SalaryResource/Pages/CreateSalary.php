<?php

namespace App\Filament\Resources\Employees\SalaryResource\Pages;

use App\Filament\Resources\Employees\SalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSalary extends CreateRecord
{
    protected static string $resource = SalaryResource::class;

    public function getTitle(): string
    {
        return __('models.create_salary');
    }

}
