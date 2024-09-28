<?php

namespace App\Filament\Resources\Events\EventServiceResource\Pages;

use App\Filament\Resources\Events\EventServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventService extends CreateRecord
{
    protected static string $resource = EventServiceResource::class;

    public function getTitle(): string
    {
        return __('models.create_service');
    }
}
 