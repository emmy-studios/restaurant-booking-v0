<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EmployeeConfirmation: string implements HasLabel, HasColor
{
    case RECEIVED = 'Received'; // El empleado confirma que recibió el pago.
    case PENDING = 'Pending'; // El empleado aún no ha recibido el pago.
    case CASHED = 'Cashed'; // El empleado ha cobrado el pago (por ejemplo, retiró el dinero).
    case DISPUTE = 'Dispute'; // El empleado reporta un problema con el pago.
    case RECLAIMED = 'Reclaimed'; // El pago está siendo reclamado.
    case PARTIALLY_RECEIVED = 'Partially Received'; // El empleado confirma que recibió solo una parte del pago.
    case REJECTED = 'Rejected'; // El empleado rechaza el pago (por ejemplo, datos incorrectos).

    public function getLabel(): ?string
    {
        return __("enums.employee_confirmation.{$this->value}");
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::RECEIVED => 'success',
            self::PENDING => 'info',
            self::CASHED => 'success',
            self::DISPUTE => 'warning',
            self::RECLAIMED => 'danger',
            self::PARTIALLY_RECEIVED => 'warning',
            self::REJECTED => 'danger',
        };
    }

}
