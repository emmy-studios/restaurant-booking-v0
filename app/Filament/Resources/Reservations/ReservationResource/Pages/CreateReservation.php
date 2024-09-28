<?php

namespace App\Filament\Resources\Reservations\ReservationResource\Pages;

use App\Filament\Resources\Reservations\ReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class; 

    public function getTitle(): string
    {
        return __('models.create_reservation');
    }
}
