<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    public static function getNavigationSort(): ?int
    {
        return 5; 
    }

    public static function getNavigationLabel(): string
    {
        return __('models.settings');    
    }

    public function getHeading(): string
    {
        return __('models.settings');
    }

}
