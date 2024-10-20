<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SaleSource: string implements HasLabel
{
    case ONLINE = 'Online';
    case ONSITE = 'On-Site';
    case EMAIL = 'Email';
    case WHATSAPP = 'WhatsApp'; 
    case MARKETPLACE = 'Marketplace';
    case PHONE_CALL = 'Phone Call';       
    case OTHER = 'Other'; 

    public function getLabel(): ?string
    {
        return $this->value;
    }

}