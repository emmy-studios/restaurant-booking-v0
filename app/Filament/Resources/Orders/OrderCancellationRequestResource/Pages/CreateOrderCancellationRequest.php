<?php

namespace App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;

use App\Filament\Resources\Orders\OrderCancellationRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderCancellationRequest extends CreateRecord
{
    protected static string $resource = OrderCancellationRequestResource::class;

    public function getTitle(): string
    {
        return __('models.create_cancellation');
    }
}
