<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use App\Filament\Employee\Widgets\EmployeeAttendancesTable;

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

    public static function getNavigationLabel(): string
    {
        return __('panels.work_activity');
    }

    public function getHeading(): string
    {
        return __('panels.work_activity');
    }

}
