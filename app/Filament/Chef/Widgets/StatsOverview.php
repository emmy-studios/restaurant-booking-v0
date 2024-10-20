<?php

namespace App\Filament\Chef\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\User;
use App\Models\Orders\Order;
use App\Models\Recipes\Ingredient;
use App\Models\Events\Event;
use Filament\Support\Enums\IconPosition;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Number of Orders', Order::count())
                ->description("New Orders: " . "4")
                ->descriptionIcon('heroicon-o-user', IconPosition::Before)
                ->color("warning"),
            Stat::make("Ingredients Available", Ingredient::count())
                ->description("Closed to Expired: ". "5")
                ->color("danger"),
            Stat::make("New Events", Event::count())
                ->description("Events Today: " . "1")
                ->color("info"),
        ];
    }
}
