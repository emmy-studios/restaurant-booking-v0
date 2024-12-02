<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Filament\Employee\Widgets\EmployeeAttendancesTable;
use App\Filament\Employee\Widgets\EmployeeOvertimeTable;
use App\Filament\Employee\Widgets\EmployeeBonusesTable;
use App\Filament\Employee\Widgets\EmployeeDeductionsTable;
use App\Filament\Employee\Widgets\EmployeeWorkActivityStats;
use App\Filament\Employee\Widgets\EmployeeWorkedHoursChart;
use App\Models\Employees\Employee;
use App\Models\Employees\Salary;
use App\Models\Employees\Schedule;

class WorkActivity extends Page
{

    public $employee;
    public $salary;
    public $schedule;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static string $view = 'filament.employee.pages.work-activity';

    public function mount()
    {
        $this->employee = Employee::where(
            'identification_code',
            Auth::user()->identification_code)->first();

        $this->salary = Salary::where('employee_id', $this->employee->id)->first();
        $this->schedule = Schedule::where('employee_id', $this->employee->id)->first();
    }

    public static function getNavigationSort(): ?int
    {
        return 9;
    }

    public function getStats(): array
    {
        return [
            EmployeeWorkActivityStats::class,
        ];
    }

    public function getWorkedHoursChart(): string
    {
        return EmployeeWorkedHoursChart::class;
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
