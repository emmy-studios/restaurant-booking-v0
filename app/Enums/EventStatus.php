<?php

namespace App\Enums;

enum EventStatus: string
{
    case CONFIRMED = 'Confirmed';
    case CANCELED = 'Canceled';
    case FINISHED = 'Finished';
    case WAITING = 'Waiting';
}