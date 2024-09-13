<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'ADMIN';
    case MANAGER = 'MANAGER';
    case CHEF = 'CHEF';
    case EMPLOYEE = 'EMPLOYEE';
    case CUSTOMER = 'CUSTOMER';
}