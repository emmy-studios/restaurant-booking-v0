<?php

namespace App\Filament\Resources\Menus\MenuScheduleResource\Pages;

use App\Filament\Resources\Menus\MenuScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMenuSchedule extends ViewRecord
{
    protected static string $resource = MenuScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_menu_schedule');
    }
}
