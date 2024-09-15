<?php

namespace App\Filament\Resources\Orders\OrderItemResource\Pages;

use App\Filament\Resources\Orders\OrderItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderItem extends ViewRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(), 
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_order_item');
    }
}
