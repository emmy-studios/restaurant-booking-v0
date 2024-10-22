<?php

namespace App\Filament\Resources\Employees\ScheduleResource\Pages;

use App\Filament\Resources\Employees\ScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchedules extends ListRecords
{
    protected static string $resource = ScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_schedule')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.schedules');
    } 
 
}
