<?php

namespace App\Filament\Resources\Purchases\PurchaseItemResource\Pages;

use App\Filament\Resources\Purchases\PurchaseItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseItem extends EditRecord
{
    protected static string $resource = PurchaseItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
