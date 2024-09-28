<?php

namespace App\Filament\Resources\Purchases\PurchaseResource\Pages;

use App\Filament\Resources\Purchases\PurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchases extends ListRecords
{
    protected static string $resource = PurchaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_purchase')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.purchases');
    } 
}
 