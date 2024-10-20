<?php

namespace App\Filament\Chef\Pages;

use Filament\Pages\Page;
use App\Filament\Chef\Widgets\NoticesTable;

class Notices extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static string $view = 'filament.chef.pages.notices';

    public function getWidgets(): array
    {
        return [
            NoticesTable::class,
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('models.notices');
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public function getHeading(): string
    {
        return __('models.notices');
    }

}
