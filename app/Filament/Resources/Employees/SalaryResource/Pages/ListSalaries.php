<?php

namespace App\Filament\Resources\Employees\SalaryResource\Pages;

use App\Filament\Resources\Employees\SalaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalaries extends ListRecords
{
    protected static string $resource = SalaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_salary')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.salaries');
    } 

} 
