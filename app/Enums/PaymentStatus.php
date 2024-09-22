<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'Pending';            
    case PROCESSING = 'Processing';     
    case SHIPPED = 'Shipped';           
    case CANCELLED = 'Cancelled';       
    case FAILED = 'Failed';             
    case ON_HOLD = 'On Hold';           
    case AWAITING_PAYMENT = 'Awaiting Payment';
    case COMPLETED = 'Completed';        
}