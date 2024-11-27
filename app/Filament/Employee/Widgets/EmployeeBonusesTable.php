<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Bonus;

class EmployeeBonusesTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Bonus::where(
                    'employee_id',
                    Employee::where('identification_code', Auth::user()->identification_code)->first()->id)
            )
            ->columns([

            ]);
    }
}
