<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CREDIT_CARD = 'Credit Card';
    case DEBIT_CARD = 'Debit Card';
    case PAYPAL = 'PayPal';
    case BANK_TRANSFER = 'Bank Transfer';
    case CASH = 'Cash';
    case CRYPTO = 'Cryptocurrency';
    case EMAIL = 'Email';
    case WHATSAPP = 'Whatsapp';
}
