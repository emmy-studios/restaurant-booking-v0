<?php

namespace App\Enums;

enum ReturnStatus: string
{
    case CANCELED = 'Canceled';
    case CONFIRMED = 'Confirmed';
    case PROCESSING = 'Processing'; 
    case SUCCESSFULLY = 'Successfully';                  
}