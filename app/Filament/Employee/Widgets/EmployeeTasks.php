<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Support\Enums\ActionSize;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeTask;
use App\Enums\TaskStatus;

class EmployeeTasks extends BaseWidget
{

    protected function getTableHeading(): string
    {
        return __('panels.employee_tasks');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                EmployeeTask::query()
                    ->whereHas('employee', function ($query) {
                        $query->where('identification_code', Auth::user()->identification_code);
                    })
            )
            ->actions([
                ActionGroup::make([
                    Action::make('viewDetails')
                        ->label(__('models.details'))
                        ->icon('heroicon-o-eye')
                        ->modalHeading(__('panels.task_details'))
                        ->modalContent(fn ($record) => view('filament.employee.pages.components.task-modal',
                            [
                                'employeeTask' => $record,
                            ])
                        )
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->color('info'),
                    EditAction::make('editAction')
                        ->modalHeading(__('panels.edit_task_status'))
                        ->form([
                            Select::make('status')
                                //->options(TaskStatus::class)
                                ->options([
                                    'In Progress' => 'In Progress',
                                    'Completed' => 'Completed',
                                    'Unfinished' => 'Unfinished',
                                ])
                                ->searchable()
                                ->label(__('panels.task_status')),
                            MarkdownEditor::make('employee_notes')
                                ->label(__('models.employee_notes')),
                        ])
                        ->color('warning')
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Task Status Updated')
                                ->body('The task status has been saved successfully.'),
                        ),
                ])
                ->tooltip('Options')
                ->iconButton()
                ->color('gray')
            ], position: ActionsPosition::BeforeCells)
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->searchable()
                    ->limit(30)
                    ->label(__('models.task_name')),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('models.description'))
                    ->searchable()
                    ->limit(30),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('models.is_read')),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->searchable()
                    ->label(__('models.due_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('supervisor.name')
                    ->label(__('models.supervised_by')),
                Tables\Columns\TextColumn::make('supervisor_comment')
                    ->label(__('models.supervisor_comment'))
                    ->limit(30),
                Tables\Columns\TextColumn::make('employee_notes')
                    ->label(__('models.employee_notes'))
                    ->limit(30),
            ]);
    }
}
