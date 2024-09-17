<?php

namespace App\Filament\Resources\Menus\MenuScheduleResource\Pages;

use App\Filament\Resources\Menus\MenuScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenuSchedule extends EditRecord
{
    protected static string $resource = MenuScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_menu_schedule');
    }
}
 