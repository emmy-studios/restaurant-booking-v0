<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Deduction;
use App\Models\Employees\Salary;

class EmployeeDeductionsTable extends BaseWidget
{
    protected function getTableHeading(): string
    {
        return __('models.deductions');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Deduction::query()
                    ->with(['salary.employee'])
                    ->where(
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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('currency_symbol')
                    ->badge()
                    ->color('info')
                    ->label(__('models.currency_symbol')),
                TextColumn::make('amount')
                    ->numeric()
                    ->label(__('models.amount'))
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.type')),
                TextColumn::make('description')
                    ->limit(30)
                    ->label(__('models.description'))
                    ->icon('heroicon-o-document-text')
                    ->iconColor('gray'),
                TextColumn::make('date_applied')
                    ->date()
                    ->icon('heroicon-o-calendar')
                    ->iconColor('gray')
                    ->label(__('models.date_applied'))
                    ->sortable(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make('viewDetails')
                        ->modalHeading(__('models.deduction'))
                        ->color('info')
                        ->label(__('models.view_deduction'))
                        ->form([
                            TextInput::make('currency_symbol')
                                ->label(__('models.currency')),
                            TextInput::make('amount')
                                ->label(__('models.amount')),
                            TextInput::make('type')
                                ->label(__('models.type')),
                            MarkdownEditor::make('description')
                                ->label(__('models.description')),
                            TextInput::make('date_applied')
                                ->label(__('models.date_applied')),
                        ]),
                    Action::make('print')
                        ->icon('heroicon-o-printer')
                        ->color('success')
                        ->label(__('panels.print_summary')),
                ])
                ->tooltip(__('panels.options'))
                ->color('info'),
            ], position: ActionsPosition::BeforeColumns);
    }
}
