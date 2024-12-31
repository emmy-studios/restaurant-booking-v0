<?php

namespace App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;

use App\Filament\Resources\Orders\OrderCancellationRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderCancellationRequest extends ViewRecord
{
    protected static string $resource = OrderCancellationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.view_cancellation');
    }

}
