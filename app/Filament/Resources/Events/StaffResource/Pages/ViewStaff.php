<?php

namespace App\Filament\Resources\Events\StaffResource\Pages;

use App\Filament\Resources\Events\StaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStaff extends ViewRecord
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    } 

    public function getTitle(): string 
    {
        return __('models.view_staff');
    }
}
