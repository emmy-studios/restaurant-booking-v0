<?php

namespace App\Filament\Resources\Employees\DeductionResource\Pages;

use App\Filament\Resources\Employees\DeductionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeduction extends CreateRecord
{
    protected static string $resource = DeductionResource::class;
}
