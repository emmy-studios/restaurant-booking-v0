<?php

namespace App\Filament\Resources\Orders\OrderItemResource\Pages;

use App\Filament\Resources\Orders\OrderItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderItem extends CreateRecord
{
    protected static string $resource = OrderItemResource::class;

    public function getTitle(): string
    {
        return __('models.create_order_item');
    }
}
 