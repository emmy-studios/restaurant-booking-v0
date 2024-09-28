<?php

namespace App\Filament\Resources\Events\EventPaymentResource\Pages;

use App\Filament\Resources\Events\EventPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventPayments extends ListRecords
{
    protected static string $resource = EventPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_payment')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.payments');
    } 
}
 