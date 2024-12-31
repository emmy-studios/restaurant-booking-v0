<?php

namespace App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;

use App\Filament\Resources\Orders\OrderCancellationRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderCancellationRequests extends ListRecords
{
    protected static string $resource = OrderCancellationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_cancellation')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.cancellation_requests');
    }

}
