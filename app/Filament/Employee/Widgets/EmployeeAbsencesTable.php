<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Split;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\Absence;
use App\Enums\AbsenceType;

class EmployeeAbsencesTable extends BaseWidget
{

    protected function getTableHeading(): string
    {
        return __('panels.employee_absences');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Absence::where(
                    'employee_id',
                    Employee::where('identification_code', Auth::user()->identification_code)->first()->id)
            )
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->modalHeading(__('models.absence'))
                        ->label(__('models.view_absence'))
                        ->form([

                            Split::make([
                                Section::make([
                                    TextInput::make('date')
                                        ->label(__('models.date'))
                                        ->suffixIcon('heroicon-o-clock')
                                        ->suffixIconColor('warning'),
                                ]),
                                Section::make([
                                    Toggle::make('justified')
                                        ->label(__('models.justified'))
                                        ->onIcon('heroicon-o-check')
                                        ->offIcon('heroicon-o-x-mark')
                                        ->onColor('success')
                                        ->offColor('danger'),
                                    Toggle::make('approved')
                                        ->label(__('models.approved'))
                                        ->onIcon('heroicon-o-check')
                                        ->offIcon('heroicon-o-x-mark')
                                        ->onColor('success')
                                        ->offColor('danger'),
                                ])->grow(false),
                            ])->from('md'),
                            Section::make([
                                Textarea::make('reason')
                                    ->label(__('models.reason'))
                                    ->rows(5),
                                Textarea::make('details')
                                    ->label(__('models.details'))
                                    ->rows(5),
                                Textarea::make('supporting_documents')
                                    ->label(__('models.supporting_documents'))
                                    ->rows(5),
                                TextInput::make('absence_type')
                                    ->label(__('models.absence_type'))
                                    ->suffixIcon('heroicon-o-tag')
                                    ->suffixIconColor('info'),
                            ]),
                            Fieldset::make('absence')
                                ->label(__('panels.administration_information'))
                                ->schema([
                                    TextInput::make('approved_by')
                                        ->suffixIcon('heroicon-o-check-circle')
                                        ->suffixIconColor('success')
                                        ->label(__('models.approved_by')),
                                    Textarea::make('approver_comment')
                                        ->label(__('models.approver_comment'))
                                        ->rows(10),
                                ])
                                ->columns(1),

                        ]),
                ])
                ->tooltip(__('models.details'))
                ->color('info'),
            ], position: ActionsPosition::BeforeColumns)
            ->headerActions([
                CreateAction::make('createAbsence')
                    ->label(__('models.create_absence'))
                    ->modalHeading(__('models.create_absence'))
                    ->form([
                        Select::make('employee_id')
                            ->label(__('models.employee'))
                            ->options([
                                Employee::where('identification_code', Auth::user()->identification_code)->first()->id => Employee::where('identification_code', Auth::user()->identification_code)->first()->name
                            ]),
                        DatePicker::make('date')
                            ->label(__('models.date'))
                            ->required(),
                        Toggle::make('justified')
                            ->label(__('models.justified'))
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->required()
                            ->required(),
                        MarkdownEditor::make('reason')
                            ->required()
                            ->label(__('models.reason')),
                        MarkdownEditor::make('details')
                            ->label(__('models.details')),
                        MarkdownEditor::make('supporting_documents')
                            ->label(__('models.supporting_documents')),
                        Select::make('absence_type')
                            ->label(__('models.absence_type'))
                            ->options(AbsenceType::class)
                            ->searchable()
                            ->required(),

                    ]),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->searchable()
                    ->sortable()
                    ->label(__('models.employee')),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->searchable()
                    ->label(__('models.date'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('justified')
                    ->boolean()
                    ->label(__('models.justified')),
                Tables\Columns\TextColumn::make('absence_type')
                    ->label(__('models.absence_type'))
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('reason')
                    ->label(__('models.reason'))
                    ->limit(30)
                    ->searchable(),
                ColumnGroup::make('Admin Info', [
                    Tables\Columns\IconColumn::make('approved')
                        ->boolean()
                        ->label(__('models.approved')),
                    Tables\Columns\TextColumn::make('approved_by')
                        ->numeric()
                        ->label(__('models.approved_by'))
                        ->sortable()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('approver_comment')
                        ->label(__('models.approver_comment'))
                        ->limit(30)
                        ->searchable(),
                ])->label(__('panels.administration_information')),
            ])
            ->filters([
                SelectFilter::make('absence_type')
                    ->label(__('models.absence_type'))
                    ->options([
                        'Personal' => 'Personal',
                        'Illness' => 'Illness',
                        'Vacation' => 'Vacation',
                        'Other' => 'Other',
                    ])
                    ->attribute('absence_type'),
                SelectFilter::make('justified')
                    ->label(__('models.justified'))
                    ->options([
                        true => __('models.justified'),
                        false => __('panels.not_justified'),
                    ])
                    ->attribute('justified'),
                SelectFilter::make('approved')
                    ->label(__('models.approved'))
                    ->options([
                        true => __('models.approved'),
                        false => __('panels.not_approved'),
                    ]),
            ]);
    }
}
