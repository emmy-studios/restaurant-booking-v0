<?php

namespace App\Enums;

enum SalaryType: string
{
    case HOURLY = 'Hourly';
    case DAILY = 'Daily';
    case WEEKLY = 'Weekly';
    case BIWEEKLY = 'Biweekly';
    case MONTHLY = 'Monthly';
    case ANNUAL = 'Annual';
    case COMMISSION_BASED = 'Commission-Based';
    case STIPEND = 'Stipend';
    case CONTRACTUAL = 'Contractual';
    case PERFORMANCE_BASED = 'Performance-Based';
}
