<?php

namespace App\Filament\Chef\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $view = 'filament.chef.pages.edit-profile'; 

    public $chef;

    public function mount()
    {
        $this->chef = Auth::user();  
    }

    public function updateInfo()
    {

    }

    public static function getNavigationLabel(): string
    {
        return __('Edit Profile');     
    }

    public function getHeading(): string
    {
        return __('Edit Profile');
    }
}
