<?php

namespace App\Filament\Employee\Widgets;

use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Attendance;
use App\Models\Employees\Salary;
use App\Models\Employees\Overtime;
use App\Models\Employees\Bonus;

class EmployeeWorkActivityStats extends BaseWidget
{
    protected function getStats(): array
    {
        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();
        $salary = Salary::where('employee_id', $employee->id)->first();
        $bonuses = Bonus::where('salary_id', $salary->id)->get();
        $attendances = Attendance::where('employee_id', $employee->id)->get();
        $overtimes = Overtime::where('employee_id', $employee->id)->get();

        $totalBonusesEarned = $bonuses->count() !== 0 ? $bonuses->count() : 0;
        $totalHoursWorked = $attendances->sum('total_work_hours');
        $totalOvertimes = $overtimes->sum('number_of_hours');

        $bonusesThisMonth = Bonus::where(
            'salary_id',
            $salary->id)->whereMonth('date_awarded', Carbon::now()->month)->count();

        $workedHoursThisMonth = Attendance::where(
            'employee_id',
            $employee->id)->whereMonth('date', Carbon::now()->month)->sum('total_work_hours');

        $overtimesThisMonth = Overtime::where(
            'employee_id',
            $employee->id)->whereMonth('overtime_date', Carbon::now()->month)->sum('number_of_hours');

        return [
            Stat::make(__('models.total_work_hours'), $totalHoursWorked)
                ->description(__('panels.stats.hours_worked_this_month') . ': ' . floor($workedHoursThisMonth))
                ->descriptionIcon('heroicon-o-hashtag', IconPosition::Before)
                ->color('success'),
            Stat::make(__('panels.stats.total_overtime'), $totalOvertimes)
                ->description(__('panels.stats.overtime_this_month') . ': ' . floor($overtimesThisMonth))
                ->descriptionIcon('heroicon-o-hashtag', IconPosition::Before)
                ->color('info'),
            Stat::make(__('panels.stats.bonuses_earned'), $totalBonusesEarned)
                ->description(__('panels.stats.bonuses_this_month') . ': ' . $bonusesThisMonth)
                ->descriptionIcon('heroicon-o-gift', IconPosition::Before)
                ->color('warning'),
        ];
    }
}
