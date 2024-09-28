<?php

namespace App\Filament\Resources\Reservations\ReservationResource\Pages;

use App\Filament\Resources\Reservations\ReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_reservation')),
        ];
    }

    public function getTitle(): string
    {
        return __('models.reservations');
    } 
}
 