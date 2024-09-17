<?php

namespace App\Enums;

enum WorkType: string
{
    case REMOTE = 'Remote';
    case ONSITE = 'On-site';
    case HYBRID = 'Hybrid';                 
}