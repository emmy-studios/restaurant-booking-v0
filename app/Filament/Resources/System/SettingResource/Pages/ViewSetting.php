<?php

namespace App\Filament\Resources\System\SettingResource\Pages;

use App\Filament\Resources\System\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSetting extends ViewRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
