<?php

namespace App\Filament\Resources\Events\EventPaymentResource\Pages;

use App\Filament\Resources\Events\EventPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEventPayment extends ViewRecord
{
    protected static string $resource = EventPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string 
    {
        return __('models.view_payment');
    }
}
 