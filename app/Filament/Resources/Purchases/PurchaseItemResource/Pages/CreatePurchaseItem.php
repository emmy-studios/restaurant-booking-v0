<?php

namespace App\Filament\Resources\Purchases\PurchaseItemResource\Pages;

use App\Filament\Resources\Purchases\PurchaseItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseItem extends CreateRecord
{
    protected static string $resource = PurchaseItemResource::class;
}
