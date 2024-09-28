<?php

namespace App\Filament\Resources\Returns\ReturnRequestResource\Pages;

use App\Filament\Resources\Returns\ReturnRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReturnRequest extends CreateRecord
{
    protected static string $resource = ReturnRequestResource::class;

    public function getTitle(): string
    {
        return __('models.create_return');
    }
}
