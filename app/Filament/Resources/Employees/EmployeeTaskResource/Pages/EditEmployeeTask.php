<?php

namespace App\Filament\Resources\Employees\EmployeeTaskResource\Pages;

use App\Filament\Resources\Employees\EmployeeTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeTask extends EditRecord
{
    protected static string $resource = EmployeeTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_task');
    }

}
