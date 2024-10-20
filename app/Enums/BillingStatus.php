<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum BillingStatus: string implements HasLabel, HasColor
{
    case PENDING = 'Pending';            
    case PROCESSING = 'Processing';               
    case CANCELLED = 'Cancelled'; 
    case REFUNDED = 'Refunded';   
    case FAILED = 'Failed';          
    case ON_HOLD = 'On Hold';           
    case AWAITING_PAYMENT = 'Awaiting Payment'; 
    case COMPLETED = 'Completed';         

    public function getLabel(): ?string
    {
        return match($this){
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::CANCELLED => 'Cancelled',
            self::REFUNDED => 'Refunded',
            self::FAILED => 'Failed',
            self::ON_HOLD => 'On Hold',
            self::AWAITING_PAYMENT => 'Awaiting Payment',
            self::COMPLETED => 'Completed',
        };
    }

    public function getColor(): string|array|null
    {
        return match($this){
            self::PENDING => 'warning',
            self::PROCESSING => 'warning',
            self::CANCELLED => 'danger',
            self::REFUNDED => 'warning',
            self::FAILED => 'danger',
            self::ON_HOLD => 'info',
            self::AWAITING_PAYMENT => 'warning',
            self::COMPLETED => 'success',
        };
    }

}