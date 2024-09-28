<?php

namespace App\Filament\Resources\Events\EventPackageResource\Pages;

use App\Filament\Resources\Events\EventPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventPackage extends CreateRecord
{
    protected static string $resource = EventPackageResource::class;

    public function getTitle(): string
    {
        return __('models.create_package');
    }
}
 