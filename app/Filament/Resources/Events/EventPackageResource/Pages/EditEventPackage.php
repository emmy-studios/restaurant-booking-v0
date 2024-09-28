<?php

namespace App\Filament\Resources\Events\EventPackageResource\Pages;

use App\Filament\Resources\Events\EventPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventPackage extends EditRecord
{
    protected static string $resource = EventPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ]; 
    }

    public function getTitle(): string
    {
        return __('models.edit_package');
    }
}
