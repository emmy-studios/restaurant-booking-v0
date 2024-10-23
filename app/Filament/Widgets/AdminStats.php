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
        return [
            Stat::make(__('models.orders'), Order::count())
                ->description('Total Orders Made')
                ->descriptionIcon('heroicon-o-clipboard-document', IconPosition::Before)
                ->color('success'),
            Stat::make(__('models.reservations'), Reservation::count())
                ->description('Total Reservations')
                ->descriptionIcon('heroicon-o-book-open', IconPosition::Before)
                ->color('warning'),
            Stat::make(__('models.sales'), Sale::count())
                ->description('Total Sales')
                ->descriptionIcon('heroicon-o-presentation-chart-bar', IconPosition::Before)
                ->color('info'),
        ];
    }
}
