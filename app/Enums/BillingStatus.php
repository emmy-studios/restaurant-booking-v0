<?php

namespace App\Enums;

enum BillingStatus: string
{
    case PENDING = 'Pending';            
    case PROCESSING = 'Processing';               
    case CANCELLED = 'Cancelled'; 
    case REFUNDED = 'Refunded';   
    case FAILED = 'Failed';          
    case ON_HOLD = 'On Hold';           
    case AWAITING_PAYMENT = 'Awaiting Payment'; 
    case COMPLETED = 'Completed';        
}