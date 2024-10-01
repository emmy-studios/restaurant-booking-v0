<?php

namespace App\Filament\Widgets;

use App\Models\Orders\Order;
use App\Models\Sales\Sale;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('models.users'), User::count())
                ->description(__('models.number_of_users'))
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->color('warning')
                ->chart([1, 56, 89, 34, 20, 90]),
            Stat::make(__('models.orders'), Order::count())
                ->description(__('models.total_orders_made'))
                ->color('info') 
                ->chart([90, 45, 87, 34, 56])
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before),
            Stat::make(__('models.sales'), Sale::count())
                ->description(__('models.total_sales'))
                ->color('danger')
                ->chart([23, 56, 12, 100])
                ->descriptionIcon('heroicon-o-presentation-chart-bar', IconPosition::Before),
        ]; 
    }
}
