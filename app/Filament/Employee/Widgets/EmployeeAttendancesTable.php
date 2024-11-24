<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Employees\Employee;
use App\Models\Employees\Attendance;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendancesTable extends BaseWidget
{
    protected function getTableHeading(): string
    {
        return __('panels.employee_attendances');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Attendance::where(
                    'employee_id',
                    Employee::where('identification_code', Auth::user()->identification_code)->first()->id)
            )
            ->columns([
                TextColumn::make('employee.name')
                    ->numeric()
                    ->searchable()
                    ->sortable()
                    ->label(__('models.employee')),
                TextColumn::make('date')
                    ->date()
                    ->searchable()
                    ->label(__('models.date'))
                    ->sortable(),
                TextColumn::make('check_in_time')
                    ->label(__('models.check_in_time'))
                    ->searchable(),
                TextColumn::make('check_out_time')
                    ->label(__('models.check_out_time'))
                    ->searchable(),
                TextColumn::make('total_work_hours')
                    ->numeric()
                    ->label(__('models.total_work_hours'))
                    ->sortable(),
                TextColumn::make('overtime_hours')
                    ->numeric()
                    ->label(__('models.overtime_hours'))
                    ->sortable(),
                TextColumn::make('overtime_rate')
                    ->numeric()
                    ->label(__('models.overtime_rate'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->tooltip('Duración en minutos')
                    ->label(__('models.lunch_break_duration'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_holiday')
                    ->boolean()
                    ->label(__('models.is_holiday'))
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_weekend')
                    ->boolean()
                    ->label(__('models.is_weekend'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('notes')
                    ->limit(30)
                    ->searchable()
                    ->label(__('models.notes'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
