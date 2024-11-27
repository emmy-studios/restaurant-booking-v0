<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Employees\Employee;
use App\Models\Employees\Overtime;
use Illuminate\Support\Facades\Auth;

class EmployeeOvertimeTable extends BaseWidget
{
    protected function getTableHeading(): string
    {
        return __('models.overtime');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Overtime::where(
                    'employee_id',
                    Employee::where('identification_code', Auth::user()->identification_code)->first()->id)
            )
            ->columns([
                TextColumn::make('employee.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->sortable(),
                TextColumn::make('overtime_date')
                    ->date()
                    ->label(__('models.overtime_date'))
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label(__('models.start_time')),
                TextColumn::make('end_time')
                    ->label(__('models.end_time')),
                TextColumn::make('number_of_hours')
                    ->numeric()
                    ->label(__('models.number_of_hours'))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                TextColumn::make('approver.name')
                    ->label(__('models.approved_by'))
                    ->sortable(),
                TextColumn::make('overtime_type')
                    ->badge()
                    ->label(__('models.overtime_type'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_method')
                    ->badge()
                    ->label(__('models.payment_method'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_currency')
                    ->badge()
                    ->label(__('models.payment_currency'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('hourly_rate')
                    ->numeric()
                    ->label(__('models.hourly_rate'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_payment')
                    ->numeric()
                    ->label(__('models.total_payment'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
