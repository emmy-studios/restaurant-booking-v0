<?php

namespace App\Filament\Widgets;

use App\Models\Orders\Order;
use App\Models\Reservations\Reservation;
use App\Models\Sales\Sale;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends BaseWidget
{
    protected function getStats(): array 
    {
        $totalOrders = Order::count();
        $totalSales = Sale::count();
        $totalReservations = Reservation::count();

        return [
            Stat::make(__('models.orders'), $totalOrders)
                ->description(__('panels.total_orders_made'))
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before)
                ->color('success'),
            Stat::make(__('models.reservations'), $totalReservations)
                ->description(__('panels.total_reservations'))
                ->descriptionIcon('heroicon-o-book-open', IconPosition::Before)
                ->color('warning'),
            Stat::make(__('models.sales'), $totalSales)
                ->description(__('panels.total_sales'))
                ->descriptionIcon('heroicon-o-presentation-chart-bar', IconPosition::Before)
                ->color('info'),
        ];
    }
}
