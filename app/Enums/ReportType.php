<?php

namespace App\Enums;

enum ReportType: string
{
    case SALES = 'Sales';
    case INVENTORY = 'Inventory';
    case EMPLOYEES = 'Employees';
    case PRODUCTS = 'Products';
    case MENUS = 'Menus';
    case INGREDIENTS = 'Ingredients';
    case GENERIC = 'Generic';
}