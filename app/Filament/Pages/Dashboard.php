<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardDailySalesReport;
use App\Filament\Widgets\DashboardReportTable;
use App\Filament\Widgets\DashboardReturnsTable;
use App\Filament\Widgets\DashboardStats;
use Carbon\Carbon;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static string $routePath = 'dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    public $adminInfo;

    public $currentDate;

    public function mount()
    {  
        $this->adminInfo = Auth::user();
        $this->currentDate = Carbon::now()->format('d M Y, l');
    } 

    public function getWidgets(): array
    {
        return [
            DashboardStats::class, 
            DashboardReportTable::class,
            DashboardDailySalesReport::class,
            DashboardReturnsTable::class, 
        ]; 
    }

}
  