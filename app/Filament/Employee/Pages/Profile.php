<?php

namespace App\Filament\Employee\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.employee.pages.profile'; 

    public $employee;

    public function mount()
    {
        $this->employee = Auth::user();
    }

    public static function getNavigationLabel(): string
    {
        return __('models.profile');     
    }

    public function getHeading(): string
    {
        return __('models.profile');
    }
}
