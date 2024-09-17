<?php

namespace App\Filament\Resources\Inventories\InventoryItemResource\Pages;

use App\Filament\Resources\Inventories\InventoryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventoryItem extends CreateRecord
{
    protected static string $resource = InventoryItemResource::class;
}
