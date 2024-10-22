<?php

namespace App\Filament\Resources\Employees\BonusResource\Pages;

use App\Filament\Resources\Employees\BonusResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBonus extends ViewRecord
{
    protected static string $resource = BonusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
