<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use App\Filament\Employee\Widgets\EmployeeTasks;
use App\Filament\Employee\Widgets\EmployeeTasksInfo;

class Tasks extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';

    protected static string $view = 'filament.employee.pages.tasks';

    public static function getNavigationLabel(): string
    {
        return __('models.tasks');
    }

    public function getHeading(): string
    {
        return __('models.tasks');
    }

    public static function getNavigationSort(): ?int
    {
        return 6;
    }

    public function getWidgets(): array
    {
        return [
            EmployeeTasksInfo::class,
            EmployeeTasks::class,
        ];
    }

}
