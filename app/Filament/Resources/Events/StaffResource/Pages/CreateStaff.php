<?php

namespace App\Filament\Resources\Events\StaffResource\Pages;

use App\Filament\Resources\Events\StaffResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;

    public function getTitle(): string
    {
        return __('models.create_staff');
    }
}
 