<?php

namespace App\Filament\Resources\Purchases\PurchaseItemResource\Pages;

use App\Filament\Resources\Purchases\PurchaseItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseItems extends ListRecords
{
    protected static string $resource = PurchaseItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_item')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.items');
    } 
} 
