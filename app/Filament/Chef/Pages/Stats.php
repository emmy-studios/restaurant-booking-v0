<?php

namespace App\Filament\Chef\Pages;

use App\Filament\Chef\Widgets\StatsWidgets;
use Filament\Pages\Page;

class Stats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.chef.pages.stats';

    public function getWidgets(): array
    {
        return [
            StatsWidgets::class, 
        ];
    }

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
        return 4;
    }

}
