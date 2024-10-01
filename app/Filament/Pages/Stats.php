<?php

namespace App\Filament\Pages;

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
}
 