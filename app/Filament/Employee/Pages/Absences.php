<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Filament\Employee\Widgets\EmployeeAbsencesTable;
use App\Filament\Employee\Widgets\EmployeeAbsencesStats;
use App\Filament\Employee\Widgets\EmployeeAbsencesChart;
use App\Filament\Employee\Widgets\EmployeeAbsencesLineChart;
use App\Filament\Employee\Widgets\EmployeeJustifiedAbsencesChart;
use App\Filament\Employee\Widgets\EmployeeAbsencesPieChart;

class Absences extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-minus';

    protected static string $view = 'filament.employee.pages.absences';

    public static function getNavigationLabel(): string
    {
        return __('models.absences');
    }

    public function getHeading(): string
    {
        return __('models.absences');
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public function mount()
    {
        //
    }

    public function getWidgets(): array
    {
        return [
            EmployeeAbsencesStats::class,
            EmployeeAbsencesTable::class,
            EmployeeAbsencesChart::class,
            EmployeeAbsencesLineChart::class,
            //EmployeeJustifiedAbsencesChart::class,
        ];
    }

    public function getEmployeeJustifiedAbsencesChartWidget(): string
    {
       return EmployeeJustifiedAbsencesChart::class;
    }

    public function getEmployeeAbsencesPieChartWidget(): string
    {
        return EmployeeAbsencesPieChart::class;
    }

}
