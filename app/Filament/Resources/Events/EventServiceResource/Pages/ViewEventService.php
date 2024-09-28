<?php

namespace App\Filament\Resources\Events\EventServiceResource\Pages;

use App\Filament\Resources\Events\EventServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventService extends ViewRecord
{
    protected static string $resource = EventServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_service');
    }
} 
