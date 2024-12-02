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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Employees\Employee;
use App\Models\Employees\Overtime;
use App\Enums\OvertimeStatus;
use App\Enums\OvertimeType;
use App\Enums\PaymentMethod;
use App\Filament\Exports\Employees\OvertimeExporter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

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
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->sortable(),
                TextColumn::make('overtime_date')
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->date()
                    ->searchable()
                    ->label(__('models.overtime_date'))
                    ->sortable(),
                TextColumn::make('start_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('gray')
                    ->searchable()
                    ->label(__('models.start_time')),
                TextColumn::make('end_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('gray')
                    ->searchable()
                    ->label(__('models.end_time')),
                TextColumn::make('number_of_hours')
                    ->icon('heroicon-o-hashtag')
                    ->iconColor('warning')
                    ->numeric()
                    ->label(__('models.number_of_hours'))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->label(__('models.status')),
                TextColumn::make('approver.name')
                    ->label(__('models.approved_by'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('overtime_type')
                    ->badge()
                    ->searchable()
                    ->label(__('models.overtime_type'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_method')
                    ->badge()
                    ->searchable()
                    ->label(__('models.payment_method'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('reason')
                    ->limit(30)
                    ->searchable()
                    ->label(__('models.reason'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_currency')
                    ->badge()
                    ->searchable()
                    ->color('success')
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
            ])
            ->filters([
                SelectFilter::make('status')
                    ->searchable()
                    ->label(__('models.status'))
                    ->options(
                        collect(OvertimeStatus::cases())
                            ->mapWithKeys(fn($status) => [$status->value => $status->getLabel()])
                            ->toArray()
                    ),
                SelectFilter::make('overtime_type')
                    ->searchable()
                    ->label(__('models.overtime_type'))
                    ->options(
                        collect(OvertimeType::cases())
                            ->mapWithKeys(fn($type) => [$type->value => $type->getLabel()])
                            ->toArray()
                    ),
                SelectFilter::make('payment_method')
                    ->searchable()
                    ->label(__('models.payment_method'))
                    ->options(
                        collect(PaymentMethod::cases())
                            ->mapWithKeys(fn($method) => [$method->value => $method->getLabel()])
                            ->toArray()
                    ),
                Filter::make('overtime_date')
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
                				fn (Builder $query, $date): Builder => $query->whereDate('overtime_date', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('overtime_date', '<=', $date),
                            );
    				})
            ])
            ->headerActions([
                ExportAction::make('export')
                    ->color('warning')
                    ->label(__('panels.export_data'))
                    ->exporter(OvertimeExporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make('viewDetails')
                        ->modalHeading(__('models.overtimes'))
                        ->color('info')
                        ->label(__('models.view_overtime'))
                        ->form([
                            Split::make([
                                Section::make([
                                    TextInput::make('overtime_date')
                                        ->label(__('models.overtime_date'))
                                        ->suffixIcon('heroicon-o-calendar')
                                        ->suffixIconColor('success'),
                                    TextInput::make('start_time')
                                        ->label(__('models.start_time'))
                                        ->suffixIcon('heroicon-o-clock')
                                        ->suffixIconColor('success'),
                                    TextInput::make('end_time')
                                        ->label(__('models.end_time'))
                                        ->suffixIcon('heroicon-o-clock')
                                        ->suffixIconColor('danger'),
                                ]),
                                Section::make([
                                    Toggle::make('is_paid')
                                        ->label(__('models.is_paid?'))
                                        ->onIcon('heroicon-o-check')
                                        ->offIcon('heroicon-o-x-mark')
                                        ->onColor('success')
                                        ->offColor('danger'),
                                    TextInput::make('payment_currency')
                                        ->label(__('models.payment_currency')),
                                    TextInput::make('total_payment')
                                        ->label(__('models.total_payment')),
                                    TextInput::make('payment_method')
                                        ->label(__('models.payment_method')),
                                ]),
                            ])->from('md'),
                            Section::make([
                                TextInput::make('number_of_hours')
                                    ->label(__('models.number_of_hours')),
                                TextInput::make('hourly_rate')
                                    ->label(__('models.hourly_rate')),
                                TextInput::make('status')
                                    ->label(__('models.status')),
                                TextInput::make('overtime_type')
                                    ->label(__('models.overtime_type')),
                            ])->columns(2),
                            Section::make([
                                Textarea::make('reason')
                                    ->label(__('models.reason'))
                                    ->rows(5)
                            ]),
                        ]),
                    Action::make('print')
                        ->label(__('panels.print'))
                        ->icon('heroicon-o-printer')
                        ->color('warning')
                        ->action(function (Overtime $record) {
                            $pdf = Pdf::loadView('filament.employee.pages.components.overtime-pdf',
                                [
                                    'record' => $record
                                ]
                            );
                            return response()->streamDownload(
                                fn() => print($pdf->stream()),
                                "Employee_Overtime_{$record->date}.pdf"
                            );
                        }),
                ])
                ->tooltip(__('panels.options'))
                ->color('info')
            ], position: ActionsPosition::BeforeColumns);
    }
}
