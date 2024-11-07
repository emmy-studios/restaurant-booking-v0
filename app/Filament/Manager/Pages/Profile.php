<?php

namespace App\Filament\Manager\Pages;


use App\Models\User;
use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.manager.pages.profile';

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public $manager;

    public $newImage;

    public function mount()
    {
        //$this->adminData = User::where('role', 'ADMIN')->first();
        $this->manager = Auth::user();
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
        $this->manager->update([
            'image_url' => $path,
        ]);

        // Reset Image
        $this->reset('newImage');

        // Redirect the Page
        return redirect()->route('filament.manager.pages.profile');

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


