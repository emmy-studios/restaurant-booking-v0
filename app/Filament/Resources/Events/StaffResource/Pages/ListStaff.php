<?php

namespace App\Filament\Resources\Events\StaffResource\Pages;

use App\Filament\Resources\Events\StaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStaff extends ListRecords
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_staff')),
        ];
    }
 
    public function getTitle(): string
    {
        return __('models.staff');
    }
}
 