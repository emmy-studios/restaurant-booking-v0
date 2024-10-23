<?php

namespace App\Filament\Widgets;

use App\Models\Employees\Employee;
use App\Models\Orders\Order;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('New Users: ' . '0')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->color('warning'),
            Stat::make('Orders this Month', Order::count())
                ->description('New Orders: ' . '0')
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before)
                ->color('danger'),
            Stat::make('Total Employees', Employee::count())
                ->description('Active Employees: ' . '0')
                ->descriptionIcon('heroicon-o-user-circle', IconPosition::Before)
                ->color('info'),
        ];
    }
}
 