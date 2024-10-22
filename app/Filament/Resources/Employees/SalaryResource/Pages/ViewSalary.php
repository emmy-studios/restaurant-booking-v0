<?php

namespace App\Filament\Resources\Employees\SalaryResource\Pages;

use App\Filament\Resources\Employees\SalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalary extends ViewRecord
{
    protected static string $resource = SalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_salary');
    }

}
