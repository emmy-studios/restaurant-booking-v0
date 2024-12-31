<?php

namespace App\Filament\Resources\Orders\OrderCancellationRequestResource\Pages;

use App\Filament\Resources\Orders\OrderCancellationRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderCancellationRequest extends EditRecord
{
    protected static string $resource = OrderCancellationRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_cancellation');
    }

}
