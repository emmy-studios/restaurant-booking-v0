<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ReportType: string implements HasLabel
{
    case SALES = 'Sales';
    case INVENTORY = 'Inventory';
    case EMPLOYEES = 'Employees';
    case CHEF = 'Chef';
    case CUSTOMER = 'Customer';
    case RETURNREQUEST = 'Return Request';
    case DISCOUNTS = 'Discounts';
    case PRODUCTS = 'Products';
    case MENUS = 'Menus';
    case INGREDIENTS = 'Ingredients';
    case GENERIC = 'Generic';

    public function getLabel(): ?string
    {
        return $this->value;
    }

}