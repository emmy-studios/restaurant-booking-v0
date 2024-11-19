<?php

namespace App\Filament\Employee\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\IconPosition;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeTask;

class EmployeeTasksInfo extends BaseWidget
{
    protected function getStats(): array
    {
        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();
        $employeeTasks = EmployeeTask::where('employee_id', $employee->id)->get();
        $completedTasks = 10;

        return [
            Stat::make('Tareas Totales', 90)
                ->description('Tareas Aprovadas: 9')
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before)
                ->color('success'),
            Stat::make('Tareas Pendientes', 10)
                ->description('Tareas Completadas este Mes: ' . '20')
                ->color('warning'),
            Stat::make('Tareas no Completadas', 20)
                ->description('Tareas Canceladas'. ' 10')
                ->color('danger'),
        ];
    }
}
