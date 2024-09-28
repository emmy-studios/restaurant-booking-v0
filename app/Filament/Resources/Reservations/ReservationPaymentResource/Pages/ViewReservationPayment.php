<?php

namespace App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;

use App\Filament\Resources\Reservations\ReservationPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReservationPayment extends ViewRecord
{
    protected static string $resource = ReservationPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
