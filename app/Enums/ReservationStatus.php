<?php

namespace App\Enums;

enum ReservationStatus: string
{
    case CONFIRMED = 'Confirmed';
    case CANCELED = 'Canceled';
    case FINISHED = 'Finished';
    case WAITING = 'Waiting';
    case PENDING = 'Pending';
}