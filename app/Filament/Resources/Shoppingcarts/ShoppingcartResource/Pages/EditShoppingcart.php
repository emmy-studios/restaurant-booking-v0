<?php

namespace App\Filament\Resources\Shoppingcarts\ShoppingcartResource\Pages;

use App\Filament\Resources\Shoppingcarts\ShoppingcartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShoppingcart extends EditRecord
{
    protected static string $resource = ShoppingcartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_shoppingcart');
    }

}
