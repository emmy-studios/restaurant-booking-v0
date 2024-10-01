<?php

namespace App\Filament\Chef\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Profile extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.chef.pages.profile';

    public $chef;

    public $newImage;

    public function mount()
    {
        $this->chef = Auth::user();
    }

    public function saveImage()
    {
        // Validate Image Url
        $this->validate([
            'newImage' => 'image|mimes:jpg,jpeg,png',
        ]);
        
        // Save Path
        $path = $this->newImage->store('users-image', 'public');
        
        // Update Image Url
        $this->chef->update([
            'image_url' => $path,
        ]);

        // Reset Image
        $this->reset('newImage');

        // Redirect the Page
        return redirect()->route('filament.chef.pages.profile');

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
 