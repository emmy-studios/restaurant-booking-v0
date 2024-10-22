<?php

namespace App\Filament\Resources\Employees\AbsenceResource\Pages;

use App\Filament\Resources\Employees\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbsences extends ListRecords
{
    protected static string $resource = AbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_absence')),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.absences');
    } 

}
