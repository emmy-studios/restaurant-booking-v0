<?php

namespace App\Enums;

enum EmployeeStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case TERMINATED = 'Terminated';
    case ONLEAVE = 'OnLeave';
}