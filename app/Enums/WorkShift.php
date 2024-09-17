<?php

namespace App\Enums;

enum WorkShift: string
{
    case MORNING = 'Morning';            
    case AFTERNOON = 'Afternoon';
    case NIGHT = 'Night';
    case FLEXIBLE = 'Flexible';       
}