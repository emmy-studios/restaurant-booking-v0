<?php

namespace App\Filament\Resources\Sales\SaleItemResource\Pages;

use App\Filament\Resources\Sales\SaleItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaleItems extends ListRecords
{
    protected static string $resource = SaleItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
