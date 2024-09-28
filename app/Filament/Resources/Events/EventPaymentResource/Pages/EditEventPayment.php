<?php

namespace App\Filament\Resources\Events\EventPaymentResource\Pages;

use App\Filament\Resources\Events\EventPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventPayment extends EditRecord
{
    protected static string $resource = EventPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.edit_event_payment');
    }
}
