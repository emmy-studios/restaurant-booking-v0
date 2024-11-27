<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OvertimeType: string implements HasLabel
{
    case DAYTIME = "Daytime"; // Horas extras diurnas
    case NIGHT = "Night"; // Horas extras nocturnas
    case HOLIDAY = "Holiday"; // Horas extras en días festivos
    case WEEKEND = "Weekend"; // Horas extras en fines de semana
    case DOUBLE_TIME = "Double Time"; // Pago doble
    case TRIPLE_TIME = "Triple Time"; // Pago triple
    case EMERGENCY = "Emergency"; // Horas extras de emergencia
    case SHIFT_OVERLAP = "Shift Overlap"; // Traslape entre turnos
    case ON_CALL = "On-Call"; // Horas extras en guardia

    public function getLabel(): ?string
    {
        return __("enums.overtime_type.{$this->value}");
    }
}
