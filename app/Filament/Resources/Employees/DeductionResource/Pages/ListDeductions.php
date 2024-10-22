<?php

namespace App\Filament\Resources\Employees\DeductionResource\Pages;

use App\Filament\Resources\Employees\DeductionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeductions extends ListRecords
{
    protected static string $resource = DeductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
