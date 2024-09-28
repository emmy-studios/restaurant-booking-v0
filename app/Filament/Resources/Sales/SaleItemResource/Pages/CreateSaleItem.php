<?php

namespace App\Filament\Resources\Sales\SaleItemResource\Pages;

use App\Filament\Resources\Sales\SaleItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSaleItem extends CreateRecord
{
    protected static string $resource = SaleItemResource::class;

    public function getTitle(): string
    {
        return __('models.create_item');
    }
}
 