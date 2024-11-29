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
    case RETURN_REQUEST = 'Return Request';
    case DISCOUNTS = 'Discounts';
    case PRODUCTS = 'Products';
    case MENUS = 'Menus';
    case INGREDIENTS = 'Ingredients';
    case GENERIC = 'Generic';
    case ABSENCES = 'Absences';
    case SALARY_PAYMENTS = 'Salary Payments';
    case DEDUCTIONS = 'Deductions';
    case EMPLOYEE_TASKS = 'Employee Tasks';
    case SCHEDULES = 'Schedules';
    case VACATIONS = 'Vacations';

    public function getLabel(): ?string
    {
        return __("enums.report_type.{$this->value}");
    }

}
