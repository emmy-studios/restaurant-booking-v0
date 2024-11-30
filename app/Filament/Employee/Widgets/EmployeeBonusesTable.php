<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Bonus;
use App\Models\Employees\Salary;
use Barryvdh\DomPDF\Facade\Pdf;

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
                TextColumn::make('description')
                    ->label(__('models.description'))
                    ->limit(30),
            ])
            ->filters([
                Filter::make('date_awarded')
                    ->label(__('models.date_awarded'))
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('models.start_date')),
                        DatePicker::make('created_until')
                            ->label(__('models.end_date')),
    				])
                    ->query(function (Builder $query, array $data): Builder {
        				return $query
            				->when(
                				$data['created_from'],
                				fn (Builder $query, $date): Builder => $query->whereDate('date_awarded', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('date_awarded', '<=', $date),
                            );
    				}),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make('viewDetails')
                        ->modalHeading(__('models.bonus'))
                        ->color('info')
                        ->label(__('models.view_bonus'))
                        ->form([
                            Section::make([
                                TextInput::make('currency_symbol')
                                    ->label(__('models.currency')),
                                TextInput::make('amount')
                                    ->label(__('models.amount')),
                                TextInput::make('date_awarded')
                                    ->suffixIcon('heroicon-o-calendar')
                                    ->suffixIconColor('info')
                                    ->label(__('models.date_awarded'))
                                    ->columnSpanFull(),
                                TextInput::make('type')
                                    ->suffixIcon('heroicon-o-check')
                                    ->suffixIconColor('info')
                                    ->label(__('models.type'))
                                    ->columnSpanFull(),
                            ])
                                ->columns(2)
                                ->description('The items you have selected for purchase')
                                ->icon('heroicon-o-gift')
                                ->iconColor('danger')
                                ->aside(),
                            Section::make([
                                Textarea::make('description')
                                    ->label(__('models.description'))
                                    ->rows(5),
                            ]),
                        ]),
                    Action::make('print')
                        ->label(__('panels.print'))
                        ->icon('heroicon-o-printer')
                        ->color('warning')
                        ->action(function (Bonus $record) {
                            $pdf = Pdf::loadView('filament.employee.pages.components.bonus-pdf',
                                [
                                    'record' => $record
                                ]
                            );
                            return response()->streamDownload(
                                fn() => print($pdf->stream()),
                                "Employee_Bonus_{$record->date_awarded}.pdf"
                            );
                        }),
                ])
                ->tooltip(__('panels.options'))
                ->color('info'),
            ], position: ActionsPosition::BeforeColumns);
    }
}
