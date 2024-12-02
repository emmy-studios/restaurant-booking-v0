<?php

namespace App\Filament\Employee\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Employees\Employee;
use App\Models\Employees\Salary;
use App\FIlament\Employee\Widgets\PanelCurrentCalendar;

class Profile extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.employee.pages.profile';

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public $employee;
    public $newImage;
    public $employeeInfo;
    public $salary;

    public function mount()
    {
        //$this->adminData = User::where('role', 'ADMIN')->first();
        $this->employee = Auth::user();
        $this->employeeInfo = Employee::where('identification_code', $this->employee->identification_code)->first();
        $this->salary = Salary::where('employee_id', $this->employeeInfo->id)->first();
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
        $this->employee->update([
            'image_url' => $path,
        ]);

        // Reset Image
        $this->reset('newImage');

        // Redirect the Page
        return redirect()->route('filament.employee.pages.profile');

    }

    public function getCalendarWidget(): string
    {
        return PanelCurrentCalendar::class;
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

