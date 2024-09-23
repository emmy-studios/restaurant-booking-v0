<?php

namespace App\Filament\Resources\Products\PriceResource\Pages;

use App\Filament\Resources\Products\PriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrices extends ListRecords
{
    protected static string $resource = PriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_price')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.prices');
    }
}
