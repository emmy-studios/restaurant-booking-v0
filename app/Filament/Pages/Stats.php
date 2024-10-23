<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminStats;
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
        return 4;
    }

    public function getWidgets(): array
    {
        return [
            AdminStats::class,
        ]; 
    }

}
 