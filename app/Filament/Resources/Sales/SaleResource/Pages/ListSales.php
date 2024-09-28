<?php

namespace App\Filament\Resources\Sales\SaleResource\Pages;

use App\Filament\Resources\Sales\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSales extends ListRecords
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_sale')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.sales');
    } 
}
