<?php

namespace App\Filament\Resources\Employees\OvertimeResource\Pages;

use App\Filament\Resources\Employees\OvertimeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOvertime extends CreateRecord
{
    protected static string $resource = OvertimeResource::class;
}
