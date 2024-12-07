<?php

namespace App\Filament\Resources\Shoppingcarts\ShoppingcartResource\Pages;

use App\Filament\Resources\Shoppingcarts\ShoppingcartResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShoppingcart extends CreateRecord
{
    protected static string $resource = ShoppingcartResource::class;

    public function getTitle(): string
    {
        return __('models.create_shoppingcart');
    }

}
