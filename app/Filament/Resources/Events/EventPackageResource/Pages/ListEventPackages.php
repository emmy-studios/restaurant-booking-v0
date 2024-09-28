<?php

namespace App\Filament\Resources\Events\EventPackageResource\Pages;

use App\Filament\Resources\Events\EventPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventPackages extends ListRecords
{
    protected static string $resource = EventPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_package')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.packages');
    } 
}
 