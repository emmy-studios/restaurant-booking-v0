<?php

namespace App\Filament\Widgets;

use App\Models\Employees\Employee;
use App\Models\Orders\Order;
use App\Models\User;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalEmployees = Employee::count();
        $ordersToday = Order::whereDate('created_at', Carbon::today())->count();
        $usersToday = User::whereDate('created_at', Carbon::today())->count();
        $activeEmployees = Employee::where('status', 'Active')->count();

        return [
            Stat::make(__('panels.total_users'), $totalUsers)
                ->description(__('panels.new_users') . ': ' . $usersToday)
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->color('warning'),
            Stat::make(__('panels.orders_made_this_day'), $ordersToday)
                ->description(__('panels.total_orders') . ': ' . $totalOrders)
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before)
                ->color('danger'),
            Stat::make(__('panels.total_employees'), $totalEmployees)
                ->description(__('panels.active_employees') . ': ' . $activeEmployees)
                ->descriptionIcon('heroicon-o-user-circle', IconPosition::Before)
                ->color('info'),
        ];
    }
}
 