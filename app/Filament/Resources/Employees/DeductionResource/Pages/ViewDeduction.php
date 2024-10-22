<?php

namespace App\Filament\Resources\Employees\DeductionResource\Pages;

use App\Filament\Resources\Employees\DeductionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDeduction extends ViewRecord
{
    protected static string $resource = DeductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
