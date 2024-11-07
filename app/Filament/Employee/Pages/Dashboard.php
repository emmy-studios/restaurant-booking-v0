<?php

namespace App\Filament\Employee\Pages;

use Carbon\Carbon;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static string $routePath = 'dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.employee.pages.dashboard';

    public $employee;

    public $notices;

    public $currentDate;

    public function mount()
    {
        $this->employee = Auth::user();
        $this->notices = $this->employee->notices;
        $this->currentDate = Carbon::now()->format('d M Y, l');
    }

    public function getWidgets(): array
    {
        return [
            //
        ];
    }

}
