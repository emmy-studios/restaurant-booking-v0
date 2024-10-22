<?php

namespace App\Filament\Resources\Employees\ScheduleResource\Pages;

use App\Filament\Resources\Employees\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSchedule extends ViewRecord
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
