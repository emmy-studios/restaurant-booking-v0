<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;

class Stats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.employee.pages.stats';

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
        return 7;
    }

}
