<?php

namespace App\Filament\Resources\Events\EventPackageResource\Pages;

use App\Filament\Resources\Events\EventPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventPackage extends ViewRecord
{
    protected static string $resource = EventPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_package');
    }
}
 