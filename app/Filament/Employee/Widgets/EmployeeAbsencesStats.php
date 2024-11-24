<?php

namespace App\Filament\Employee\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\IconPosition;
use App\Models\Employees\Employee;
use App\Models\Employees\Absence;

class EmployeeAbsencesStats extends BaseWidget
{
    protected function getStats(): array
    {
        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();
        $absences = Absence::where('employee_id', $employee->id)->get();

        $totalAbsences = $absences->count();
        $justifiedAbsences = Absence::where('justified', true)->count();
        $notJustifiedAbsences = Absence::where('justified', false)->count();
        $approvedAbsences = Absence::where('approved', true)->count();
        $notApprovedAbsences = Absence::where('approved', false)->count();

        return [
            Stat::make(__('panels.total_absences'), $totalAbsences),
            Stat::make(__('panels.justified_absences'), $justifiedAbsences)
                ->description(__('panels.not_justified_absences') . ': ' . $notJustifiedAbsences)
                ->color('danger'),
            Stat::make(__('panels.approved_absences'), $approvedAbsences)
                ->description(__('panels.not_approved_absences') . ': ' . $notApprovedAbsences)
                ->color('warning'),
        ];
    }
}
