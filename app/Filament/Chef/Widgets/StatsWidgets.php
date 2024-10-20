<?php

namespace App\Filament\Chef\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Hours Worked', User::count())
                ->description('Extra Hours Worked: ' . User::count())
                ->color('info'),
            Stat::make('Notices', User::count())
                ->description('New Notices: ' . User::count())
                ->color('warning'),
            Stat::make('Days of Works', User::count())
                ->description('Absences this Month: ' . User::count())
                ->color('danger'),
        ];
    }
}
