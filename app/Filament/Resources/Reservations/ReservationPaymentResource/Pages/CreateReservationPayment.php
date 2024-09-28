<?php

namespace App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;

use App\Filament\Resources\Reservations\ReservationPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReservationPayment extends CreateRecord
{
    protected static string $resource = ReservationPaymentResource::class;

    public function getTitle(): string
    {
        return __('models.create_payment');
    }
}
 