<?php

namespace App\Filament\Resources\Employees\VacationResource\Pages;

use App\Filament\Resources\Employees\VacationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVacation extends EditRecord
{
    protected static string $resource = VacationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_vacation');
    }

}
