<?php

namespace App\Filament\Resources\Employees\OvertimeResource\Pages;

use App\Filament\Resources\Employees\OvertimeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOvertime extends EditRecord
{
    protected static string $resource = OvertimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
