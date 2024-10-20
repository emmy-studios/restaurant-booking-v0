<?php

namespace App\Filament\Chef\Pages;

use Illuminate\Support\Facades\Auth;

use App\Filament\Chef\Widgets\StatsOverview;
use App\Filament\Chef\Widgets\NewOrderTable;
use App\Filament\Chef\Widgets\NewOrderItemTable;
use App\Models\User;
use App\Models\Notice;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static string $routePath = 'dashboard';

    protected static string $view = 'filament.chef.pages.dashboard';

    public $chef;
    public $notices;

    public function mount()
    {
        $this->chef = Auth::user();
        $this->notices = $this->chef->notices;
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            NewOrderTable::class,
            NewOrderItemTable::class,
        ];
    }

}
