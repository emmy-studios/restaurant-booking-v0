<?php

namespace App\Filament\Resources\Menus\MenuScheduleResource\Pages;

use App\Filament\Resources\Menus\MenuScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenuSchedules extends ListRecords
{
    protected static string $resource = MenuScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_menu_schedule')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.menu_schedules');
    }
}
 