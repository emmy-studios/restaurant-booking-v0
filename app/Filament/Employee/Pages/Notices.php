<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Filament\Employee\Widgets\EmployeeNotices;

class Notices extends Page
{

    public $employee;
    public $notices;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static string $view = 'filament.employee.pages.notices';

    public static function getNavigationLabel(): string
    {
        return __('models.notices');
    }

    public function getHeading(): string
    {
        return __('models.notices');
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public function mount()
    {

        $this->employee = Auth::user();

    }

    public function getWidgets(): array
    {
        return [
            EmployeeNotices::class,
        ];
    }

}
