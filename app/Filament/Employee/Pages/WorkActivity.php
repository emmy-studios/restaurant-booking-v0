<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use App\Filament\Employee\Widgets\EmployeeAttendancesTable;
use App\Filament\Employee\Widgets\EmployeeOvertimeTable;
use App\Filament\Employee\Widgets\EmployeeBonusesTable;
use App\Filament\Employee\Widgets\EmployeeDeductionsTable;

class WorkActivity extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string $view = 'filament.employee.pages.work-activity';

    public static function getNavigationSort(): ?int
    {
        return 9;
    }

    public function getEmployeeAttendancesTable(): string
    {
        return EmployeeAttendancesTable::class;
    }

    public function getWidgets(): array
    {
        return [
            EmployeeAttendancesTable::class,
            EmployeeOvertimeTable::class,
            EmployeeBonusesTable::class,
            EmployeeDeductionsTable::class,
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('panels.work_activity');
    }

    public function getHeading(): string
    {
        return __('panels.work_activity');
    }

}
