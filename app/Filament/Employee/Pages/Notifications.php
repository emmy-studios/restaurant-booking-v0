<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use App\Filament\Employee\Widgets\EmployeeNotifications;

class Notifications extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static string $view = 'filament.employee.pages.notifications';

    public static function getNavigationLabel(): string
    {
        return __('models.notifications');
    }

    public function getHeading(): string
    {
        return __('models.notifications');
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public function getWidgets(): array
    {
        return [
            EmployeeNotifications::class,
        ];
    }

}
