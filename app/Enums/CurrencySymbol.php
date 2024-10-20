<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum CurrencySymbol: string implements HasLabel
{
    case USD = 'USD $';       // Dólar estadounidense
    case CRC = 'CRC ₡';       // Cólon costarricense
    case EUR = 'EUR €';       // Euro
    case GBP = 'GBP £';       // Libra esterlina
    case JPY = 'JPY ¥';       // Yen japonés
    case CHF = 'CHF CHF';     // Franco suizo
    case CAD = 'CAD $';       // Dólar canadiense
    case AUD = 'AUD $';       // Dólar australiano
    case NZD = 'NZD $';       // Dólar neozelandés
    case CNY = 'CNY ¥';       // Yuan chino
    case INR = 'INR ₹';       // Rupia india
    case RUB = 'RUB ₽';       // Rublo ruso
    case BRL = 'BRL R$';      // Real brasileño
    case ZAR = 'ZAR R';       // Rand sudafricano
    case KRW = 'KRW ₩';       // Won surcoreano
    case MXN = 'MXN $';       // Peso mexicano
    case ARS = 'ARS $';       // Peso argentino
    case CLP = 'CLP $';       // Peso chileno
    case COP = 'COP $';       // Peso colombiano
    case PEN = 'PEN S/';      // Sol peruano
    case DKK = 'DKK kr';      // Corona danesa
    case NOK = 'NOK kr';      // Corona noruega
    case SEK = 'SEK kr';      // Corona sueca
    case PLN = 'PLN zł';      // Złoty polaco
    case TRY = 'TRY ₺';       // Lira turca
    case AED = 'AED د.إ';     // Dírham de los Emiratos Árabes Unidos
    case SAR = 'SAR ﷼';      // Rial saudí
    case KWD = 'KWD د.ك';    // Dinar kuwaití
    case BHD = 'BHD .د.ب';   // Dinar bareiní
    case ILS = 'ILS ₪';       // Shekel israelí
    case SGD = 'SGD $';       // Dólar de Singapur
    case HKD = 'HKD $';       // Dólar de Hong Kong
    case THB = 'THB ฿';       // Baht tailandés
    case MYR = 'MYR RM';      // Ringgit malasio
    case IDR = 'IDR Rp';      // Rupia indonesia

    public function getLabel(): ?string
    {
        return $this->value;
    }

}
