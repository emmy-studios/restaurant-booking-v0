<?php

namespace App\Filament\Resources\Menus\MenuScheduleResource\Pages;

use App\Filament\Resources\Menus\MenuScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuSchedule extends CreateRecord
{
    protected static string $resource = MenuScheduleResource::class;

    public function getTitle(): string
    {
        return __('models.create_menu_schedule');
    }
}
 