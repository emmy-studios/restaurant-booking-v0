<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel
{
    case CREDIT_CARD = 'Credit Card';
    case DEBIT_CARD = 'Debit Card';
    case PAYPAL = 'PayPal';
    case BANK_TRANSFER = 'Bank Transfer';
    case CASH = 'Cash';
    case CRYPTO = 'Cryptocurrency';
    case EMAIL = 'Email';
    case WHATSAPP = 'Whatsapp';

    public function getLabel(): ?string
    {
        return $this->value;
    }

}
