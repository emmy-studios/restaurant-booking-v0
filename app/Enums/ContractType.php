<?php

namespace App\Enums;

enum ContractType: string
{
    case PERMANENT = 'Permanent';
    case TEMPORARY = 'Temporary';
    case FREELANCE = 'Freelance';
    case INTERN = 'Intern';
    case CONTRACTOR = 'Contractor';
    case PART_TIME = 'Part-Time';
    case CONSULTANT = 'Consultant';
    case SEASONAL = 'Seasonal';
}
