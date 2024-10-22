<?php

namespace App\Filament\Resources\Employees\VacationResource\Pages;

use App\Filament\Resources\Employees\VacationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVacation extends CreateRecord
{
    protected static string $resource = VacationResource::class;

    public function getTitle(): string
    {
        return __('models.create_vacation');
    }

}
