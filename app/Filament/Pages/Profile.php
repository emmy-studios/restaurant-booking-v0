<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.profile';

    public $adminData;

    public function mount() 
    {
        $this->adminData = User::where('role', 'ADMIN')->first();
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

