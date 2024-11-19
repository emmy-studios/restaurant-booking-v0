<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;

class EmployeeInformation extends Page
{

    public $employee;

    public $employeeInfo;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static string $view = 'filament.employee.pages.employee-information';

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public function mount()
    {

        $this->employee = Auth::user();
        $this->employeeInfo = Employee::where('identification_code', Auth::user()->identification_code)->first();

    }

    public static function getNavigationLabel(): string
    {
        return __('panels.employee_information');
    }

    public function getHeading(): string
    {
        return __('panels.employee_information');
    }

}
