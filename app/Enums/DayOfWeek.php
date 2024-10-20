<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DayOfWeek: string implements HasLabel
{
    case MONDAY = 'Monday';
    case TUESDAY = 'Tuesday';
    case WEDNESDAY = 'Wednesday';
    case THURSDAY = 'Thursday';
    case FRIDAY = 'Friday';
    case SATURDAY = 'Saturday';
    case SUNDAY = 'Sunday';           

    public function getLabel(): ?string
    {
        return $this->value;
    }

}