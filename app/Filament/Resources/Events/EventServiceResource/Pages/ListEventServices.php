<?php

namespace App\Filament\Resources\Events\EventServiceResource\Pages;

use App\Filament\Resources\Events\EventServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventServices extends ListRecords
{
    protected static string $resource = EventServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_service')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.services');
    } 
} 
