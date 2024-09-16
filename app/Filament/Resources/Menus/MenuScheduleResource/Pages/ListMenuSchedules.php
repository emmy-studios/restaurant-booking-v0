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
            Actions\CreateAction::make(),
        ];
    }
}
