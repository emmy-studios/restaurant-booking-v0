<?php

namespace App\Filament\Resources\Employees\BonusResource\Pages;

use App\Filament\Resources\Employees\BonusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBonuses extends ListRecords
{
    protected static string $resource = BonusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
