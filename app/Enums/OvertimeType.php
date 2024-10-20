<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OvertimeType: string implements HasLabel
{
    case Daytime = "DayTime";
    case Night = "Night";
    case Holiday = "Holiday";

    public function getLabel(): ?string
    {
        return $this->value;
    }
}