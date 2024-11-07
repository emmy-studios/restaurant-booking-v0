<?php

namespace App\Filament\Manager\Pages;

use Carbon\Carbon;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static string $routePath = 'dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.manager.pages.dashboard';

    public $manager;

    public $currentDate;

    public function mount()
    {
        $this->manager = Auth::user();
        $this->currentDate = Carbon::now()->format('d M Y, l');
    }

    public function getWidgets(): array
    {
        return [
            //
        ];
    }

}

