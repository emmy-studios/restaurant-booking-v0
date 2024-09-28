<?php

namespace App\Filament\Resources\Events\EventServiceResource\Pages;

use App\Filament\Resources\Events\EventServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventService extends EditRecord
{
    protected static string $resource = EventServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_service');
    }
} 
