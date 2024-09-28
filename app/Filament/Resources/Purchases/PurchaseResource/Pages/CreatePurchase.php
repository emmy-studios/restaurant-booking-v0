<?php

namespace App\Filament\Resources\Purchases\PurchaseResource\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class; 

    public function getTitle(): string
    {
        return __('models.create_purchase');
    }
}
