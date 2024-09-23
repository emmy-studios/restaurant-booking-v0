<?php

namespace App\Filament\Resources\Products\PriceResource\Pages;

use App\Filament\Resources\Products\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrice extends CreateRecord
{
    protected static string $resource = PriceResource::class;

    public function getTitle(): string
    {
        return __('models.create_price');
    }
}
 