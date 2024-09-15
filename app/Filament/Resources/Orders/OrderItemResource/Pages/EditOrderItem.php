<?php

namespace App\Filament\Resources\Orders\OrderItemResource\Pages;

use App\Filament\Resources\Orders\OrderItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderItem extends EditRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(), 
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_order_item');
    }
}
