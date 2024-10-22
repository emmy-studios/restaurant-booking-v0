<?php

namespace App\Filament\Resources\Employees\AbsenceResource\Pages;

use App\Filament\Resources\Employees\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAbsence extends EditRecord
{
    protected static string $resource = AbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
