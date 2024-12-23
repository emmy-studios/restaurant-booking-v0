<?php

namespace App\Filament\Employee\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Absence;

class EmployeeJustifiedAbsencesChart extends ChartWidget
{

    protected static ?string $heading = null;

    protected static string $color = 'info';

    protected static ?string $maxHeight = '300px';

    /*public function getDescription(): ?string
    {
        return __('panels.the_number_of_absences_made_this_month');
    }

    public function __construct()
    {
        static::$heading = __('panels.absences_this_month');
    }*/

    protected function getData(): array
    {

        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();

        $justifiedAbsences = Absence::where('employee_id', $employee->id)->where('justified', true)->count();
        $notJustifiedAbsences = Absence::where('employee_id', $employee->id)->where('justified', false)->count();
        $approvedAbsences = Absence::where('employee_id', $employee->id)->where('approved', true)->count();
        $notApprovedAbsences = Absence::where('employee_id', $employee->id)->where('approved', false)->count();

    	return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [$justifiedAbsences, $notJustifiedAbsences, $approvedAbsences, $notApprovedAbsences],
                    'backgroundColor'=> [
                        '#f7aef8',
                        '#ff9b85',
                        '#60d394',
                        '#f25757',
                    ],
                    'hoverOffset' => 7,
                    'weight' => 10,
                ],
            ],
            'labels' => [
                __('models.justified'),
                __('panels.not_justified'),
                __('models.approved'),
                __('panels.not_approved')
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
