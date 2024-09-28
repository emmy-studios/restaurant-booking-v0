<?php

namespace App\Filament\Resources\Reservations\ReservationPaymentResource\Pages;

use App\Filament\Resources\Reservations\ReservationPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReservationPayment extends EditRecord
{
    protected static string $resource = ReservationPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
