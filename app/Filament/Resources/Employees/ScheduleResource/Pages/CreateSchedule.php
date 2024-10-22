<?php

namespace App\Filament\Resources\Employees\ScheduleResource\Pages;

use App\Filament\Resources\Employees\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchedule extends CreateRecord
{
    protected static string $resource = ScheduleResource::class;

    public function getTitle(): string
    {
        return __('models.create_schedule');
    }

}
