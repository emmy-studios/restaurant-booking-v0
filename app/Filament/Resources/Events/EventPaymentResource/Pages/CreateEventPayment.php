<?php

namespace App\Filament\Resources\Events\EventPaymentResource\Pages;

use App\Filament\Resources\Events\EventPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventPayment extends CreateRecord
{
    protected static string $resource = EventPaymentResource::class;

    public function getTitle(): string
    {
        return __('models.create_payment');
    }
}
 