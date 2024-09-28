<?php

namespace App\Filament\Resources\Reservations\ReservationResource\Pages;

use App\Filament\Resources\Reservations\ReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_reservation');
    }
}
 