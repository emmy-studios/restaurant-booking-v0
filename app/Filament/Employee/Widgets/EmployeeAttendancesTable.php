<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use App\Models\Employees\Employee;
use App\Models\Employees\Attendance;
use App\Filament\Exports\Employees\AttendanceExporter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

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
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.employee')),
                TextColumn::make('date')
                    ->icon('heroicon-o-calendar')
                    ->iconColor('gray')
                    ->date()
                    ->searchable()
                    ->label(__('models.date'))
                    ->sortable(),
                TextColumn::make('check_in_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('info')
                    ->label(__('models.check_in_time'))
                    ->searchable(),
                TextColumn::make('check_out_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('info')
                    ->label(__('models.check_out_time'))
                    ->searchable(),
                TextColumn::make('total_work_hours')
                    ->icon('heroicon-o-hashtag')
                    ->iconColor('gray')
                    ->numeric()
                    ->label(__('models.total_work_hours'))
                    ->sortable(),
                TextColumn::make('lunch_break_duration')
                    ->numeric()
                    ->tooltip(__('panels.duration_in_minute'))
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
                    ->icon('heroicon-o-document')
                    ->iconColor('gray')
                    ->limit(30)
                    ->searchable()
                    ->label(__('models.notes'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                ExportAction::make('export')
                    ->color('warning')
                    ->label(__('panels.export_attendances'))
                    ->exporter(AttendanceExporter::class),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make('viewDetails')
                        ->modalHeading(__('models.attendance'))
                        ->color('info')
                        ->label(__('models.view_attendance'))
                        ->form([
                            Split::make([
                                Section::make([
                                    TextInput::make('date')
                                        ->label(__('models.date'))
                                        ->suffixIcon('heroicon-o-calendar')
                                        ->suffixIconColor('success'),
                                    TextInput::make('check_in_time')
                                        ->label(__('models.check_in_time'))
                                        ->suffixIcon('heroicon-o-clock')
                                        ->suffixIconColor('success'),
                                    TextInput::make('check_out_time')
                                        ->label(__('models.check_out_time'))
                                        ->suffixIcon('heroicon-o-clock')
                                        ->suffixIconColor('success'),
                                ]),
                                Section::make([
                                    Toggle::make('is_holiday')
                                        ->label(__('models.is_holiday'))
                                        ->onIcon('heroicon-o-check')
                                        ->offIcon('heroicon-o-x-mark')
                                        ->onColor('success')
                                        ->offColor('danger'),
                                    Toggle::make('is_weekend')
                                        ->label(__('models.is_weekend'))
                                        ->onIcon('heroicon-o-check')
                                        ->offIcon('heroicon-o-x-mark')
                                        ->onColor('success')
                                        ->offColor('danger'),
                                ]),
                            ])->from('md'),
                            Section::make([
                                TextInput::make('total_work_hours')
                                    ->label(__('models.total_work_hours'))
                                    ->suffixIcon('heroicon-o-hashtag')
                                    ->suffixIconColor('warning'),
                                TextInput::make('lunch_break_duration')
                                    ->label(__('models.lunch_break_duration'))
                                    ->suffixIcon('heroicon-o-clock')
                                    ->suffixIconColor('success'),
                                Textarea::make('notes')
                                    ->label(__('models.notes'))
                                    //->suffixIcon('heroicon-o-pencil')
                                    //->suffixIconColor('info'),
                                    ->rows(10)
                            ]),
                        ]),
                    Action::make('print')
                        ->label(__('panels.print'))
                        ->icon('heroicon-o-printer')
                        ->color('warning')
                        ->action(function (Attendance $record) {
                            $pdf = Pdf::loadView('filament.employee.pages.components.attendance-pdf',
                                [
                                    'record' => $record
                                ]
                            );
                            return response()->streamDownload(
                                fn() => print($pdf->stream()),
                                "Employee_Attendance_{$record->date}.pdf"
                            );
                        })
                ])
                ->tooltip(__('panels.options'))
                ->color('info'),
            ], position: ActionsPosition::BeforeColumns)
            ->filters([
                Filter::make('is_weekend')
                    ->label(__('models.is_weekend'))
                    ->query(
                        function ($query) {
                            return $query->where('is_weekend', true);
                        }
                    ),
                Filter::make('is_holiday')
                    ->label(__('models.is_holiday'))
                    ->query(
                        function ($query) {
                            return $query->where('is_holiday', true);
                        }
                    ),

                Filter::make('date')
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
                				fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
    				})

            ]);
    }
}
