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
    case MOBILE_PAYMENT = 'Mobile Payment'; // Ejemplo: Apple Pay, Google Pay
    case CHEQUE = 'Cheque';
    case WIRE_TRANSFER = 'Wire Transfer'; // Transferencias internacionales
    case DIRECT_DEBIT = 'Direct Debit'; // Débito automático
    case E_WALLET = 'E-Wallet'; // Ejemplo: Venmo, Alipay, WeChat Pay
    case POSTAL_ORDER = 'Postal Order';
    case UPI = 'Unified Payments Interface'; // Ejemplo: UPI en India
    case QR_CODE = 'QR Code Payment'; // Pagos por código QR
    case WHATSAPP = 'WhatsApp';
    case EMAIL = 'Email Payment'; // Envío de solicitud de pago por correo electrónico
    case CASH_ON_DELIVERY = 'Cash on Delivery'; // Pago contra entrega

    public function getLabel(): ?string
    {
        return __("enums.payment_method.{$this->value}");

    }

}
