<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AbsenceType: string implements HasLabel
{
    case VACATION = "Vacation";
    case PERSONAL = "Personal";
    case UNJUSTIFIED = "Unjustified";
    case OTHER = "Other";
    case ILLNESS = "Illness";

    public function getLabel(): ?string
    {
        return $this->value;
    }

}
