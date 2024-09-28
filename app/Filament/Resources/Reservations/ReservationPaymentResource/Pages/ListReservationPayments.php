<?php

namespace App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;

use App\Filament\Resources\Reservations\ReservationPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservationPayments extends ListRecords
{
    protected static string $resource = ReservationPaymentResource::class;

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
