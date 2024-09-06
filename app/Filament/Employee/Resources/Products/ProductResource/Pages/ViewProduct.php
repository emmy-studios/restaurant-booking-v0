<?php

namespace App\Filament\Employee\Resources\Products\ProductResource\Pages;

use App\Filament\Employee\Resources\Products\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
