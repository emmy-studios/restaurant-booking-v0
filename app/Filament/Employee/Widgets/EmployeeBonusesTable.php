<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Bonus;
use App\Models\Employees\Salary;

class EmployeeBonusesTable extends BaseWidget
{

    protected function getTableHeading(): string
    {
        return __('models.bonuses');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Bonus::where(
                    'salary_id',
                    Salary::where(
                        'employee_id',
                        Employee::where(
                            'identification_code',
                            Auth::user()->identification_code
                        )->first()->id
                    )->first()->id
                )
            )
            ->columns([
                TextColumn::make('salary.employee.name')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->label(__('models.employee'))
                    ->sortable(),
                TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol'))
                    ->badge()
                    ->color('primary'),
                TextColumn::make('amount')
                    ->numeric()
                    ->label(__('models.amount'))
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.type')),
                TextColumn::make('date_awarded')
                    ->date()
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->label(__('models.date_awarded'))
                    ->sortable(),
            ]);
    }
}
