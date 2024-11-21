<?php

namespace App\Filament\Employee\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\IconPosition;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeTask;
use App\Enums\TaskStatus;

class EmployeeTasksInfo extends BaseWidget
{
    protected function getStats(): array
    {

        $employee = Employee::where('identification_code', Auth::user()->identification_code)->first();
        $employeeTasks = EmployeeTask::where('employee_id', $employee->id)->get();
        // Get Task Information
        $totalTasks = $employeeTasks->count();
        $approvedTasks = $employeeTasks->where('status', 'Approved')->count();
        $cancelledTasks = $employeeTasks->where('status', 'Cancelled')->count();
        $pendingTasks = $employeeTasks->where('status', 'Pending')->count();
        $inprogressTasks = $employeeTasks->where('status', 'In Progress')->count();
        $completedTasks = $employeeTasks->where('status', 'Completed')->count();

        return [
            Stat::make('Tareas Totales', $totalTasks)
                ->description('Tareas Aprovadas: ' . $approvedTasks)
                ->descriptionIcon('heroicon-o-check-circle', IconPosition::Before)
                ->color('success'),
            Stat::make('Tareas Pendientes', $pendingTasks)
                ->description('Tareas Canceladas: ' . $cancelledTasks)
                ->descriptionIcon('heroicon-o-x-circle', IconPosition::Before)
                ->color('danger'),
            Stat::make('Tareas Completadas', $completedTasks)
                ->description('Tareas en Progreso: '. $inprogressTasks)
                ->descriptionIcon('heroicon-o-ellipsis-horizontal-circle', IconPosition::Before)
                ->color('warning'),
        ];
    }
}
