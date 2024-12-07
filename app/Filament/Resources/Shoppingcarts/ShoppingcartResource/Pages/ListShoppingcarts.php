<?php

namespace App\Filament\Resources\Shoppingcarts\ShoppingcartResource\Pages;

use App\Filament\Resources\Shoppingcarts\ShoppingcartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShoppingcarts extends ListRecords
{
    protected static string $resource = ShoppingcartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_shoppingcart')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.shoppingcarts');
    }
}
