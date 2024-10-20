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

    public function getLabel(): ?string
    {
        return $this->value;
    } 

}