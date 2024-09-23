<?php

namespace App\Filament\Resources\Products\PriceResource\Pages;

use App\Filament\Resources\Products\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPrice extends ViewRecord
{
    protected static string $resource = PriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_price');
    }
}
