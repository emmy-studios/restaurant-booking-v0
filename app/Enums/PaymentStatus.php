<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasLabel
{
    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case SHIPPED = 'Shipped';
    case CANCELLED = 'Cancelled';
    case FAILED = 'Failed';
    case ON_HOLD = 'On Hold';
    case AWAITING_PAYMENT = 'Awaiting Payment';
    case COMPLETED = 'Completed';
    case REFUNDED = 'Refunded';              // Nuevo: Pago reembolsado
    case PARTIALLY_PAID = 'Partially Paid';  // Nuevo: Pago parcial
    case DISPUTED = 'Disputed';             // Nuevo: Pago en disputa
    case REVERSED = 'Reversed';             // Nuevo: Pago revertido
    case UNDER_REVIEW = 'Under Review';     // Nuevo: Pago bajo revisión
    case AUTHORIZED = 'Authorized';         // Nuevo: Pago autorizado pero no capturado
    case DECLINED = 'Declined';             // Nuevo: Pago declinado
    case EXPIRED = 'Expired';               // Nuevo: Autorización expirada
    case SUSPENDED = 'Suspended';

    public function getLabel(): ?string
    {
        return __("enums.payment_status.{$this->value}");
    }

}
