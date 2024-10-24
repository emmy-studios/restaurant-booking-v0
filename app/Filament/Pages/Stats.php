<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminStats;
use App\Filament\Widgets\OrdersByMonth;
use App\Filament\Widgets\OrdersLineChart;
use App\Filament\Widgets\ReservationsPerMonth;
use App\Filament\Widgets\SalesLineChart;
use Filament\Pages\Page;

class Stats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.stats';

    public static function getNavigationLabel(): string
    {
        return __('models.stats');    
    }

    public function getHeading(): string
    {
        return __('models.stats');  
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            AdminStats::class,
            OrdersByMonth::class,
            OrdersLineChart::class,
            SalesLineChart::class,
            ReservationsPerMonth::class,
        ]; 
    }

}
 