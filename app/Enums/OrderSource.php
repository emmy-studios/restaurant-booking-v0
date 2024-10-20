<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OrderSource: string implements HasLabel
{
    case ONLINE = 'Online';       
    case EMAIL = 'Email';                
    case WHATSAPP = 'WhatsApp';           
    case SOCIAL_MEDIA = 'Social Media';   
    case PHONE_CALL = 'Phone Call';       
    case WALK_IN = 'Walk-in';             
    case SMS = 'SMS';                    
    case MOBILEAPP = 'Mobile App';
    case MARKETPLACE = 'Marketplace';
    case OTHER = 'Other';                
    case PARTNERPORTAL = 'Partner Portal';

    public function getLabel(): ?string
    {
        return $this->value;
    }

}