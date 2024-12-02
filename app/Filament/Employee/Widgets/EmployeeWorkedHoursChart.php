<?php

namespace App\Filament\Employee\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Attendance;
use App\Models\Employees\Overtime;

class EmployeeWorkedHoursChart extends ChartWidget
{
    protected static ?string $heading = null;

    protected static string $color = 'info';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();

        $totalWorkedHours = Attendance::where(
            'employee_id',
            $employee->id)->sum('total_work_hours');

        $hoursWorkedThisMonth = Attendance::where(
            'employee_id',
            $employee->id)->whereMonth('date', Carbon::now()->month)->sum('total_work_hours');

        $totalOvertimes = Overtime::where('employee_id', $employee->id)->sum('number_of_hours');

        $overtimesThisMonth = Overtime::where(
            'employee_id',
            $employee->id)->whereMonth('overtime_date', Carbon::now()->month)->sum('number_of_hours');

        return [
            'datasets' => [
                [
                    'data' => [
                        $totalWorkedHours,
                        $hoursWorkedThisMonth,
                        //$totalOvertimes,
                        //$overtimesThisMonth
                    ],
                    'backgroundColor'=> [
                        '#f7aef8',
                        //'#ff9b85',
                        '#b388eb',
                        //'#AB886D',
                    ],
                    'hoverOffset' => 7,
                    'weight' => 10,
                ],
            ],
            'labels' => [
                __('models.total_work_hours'),
                __('panels.stats.hours_worked_this_month'),
                //__('models.overtimes'),
                //__('panels.stats.overtime_this_month')
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
        'scales' => [
            'x' => [
                'display' => false, // Ocultar eje X.
            ],
            'y' => [
                'display' => false, // Ocultar eje Y.
            ],
        ],
        'layout' => [
            'padding' => 20, // Ajustar el padding alrededor de la gráfica.
        ],
        'maintainAspectRatio' => false,
    ];
}
