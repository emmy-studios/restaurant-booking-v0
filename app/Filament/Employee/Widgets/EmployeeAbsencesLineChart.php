<?php

namespace App\Filament\Employee\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Absence;

class EmployeeAbsencesLineChart extends ChartWidget
{
    protected static ?string $heading = null;

    protected static string $color = 'warning';

    protected static ?string $maxHeight = '300px';

    public function getDescription(): ?string
    {
        return __('panels.the_number_of_absences_in_this_month');
    }

    public function __construct()
    {
        static::$heading = __('panels.absences_this_month');
    }

    protected function getData(): array
    {
        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();

        $data = Trend::query(Absence::where('employee_id', $employee->id))
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->dateColumn('date')
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('panels.absences_this_month'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    //'backgroundColor' => '#36A2EB',
                    //'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
