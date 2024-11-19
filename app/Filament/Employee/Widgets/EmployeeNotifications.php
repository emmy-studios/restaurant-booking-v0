<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class EmployeeNotifications extends BaseWidget
{

    protected function getTableHeading(): string
    {
        return __('panels.employee_notifications');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Notification::where("user_id", Auth::id()))
            ->actions([
                Action::make('viewDetails')
                    ->label(__('models.details'))
                    ->icon('heroicon-o-eye')
                    ->modalHeading(__('panels.notification_details'))
                    ->modalContent(fn ($record) => view('filament.employee.pages.components.notification-modal',
                        [
                            'notification' => $record,
                        ])
                    )
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->color('info')
            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('models.user'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('models.role'))
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('models.title')),
                Tables\Columns\TextColumn::make('notification_type')
                    ->label(__('models.notification_type'))
                    ->searchable()
                    ->badge()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('models.is_read')),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('models.message'))
                    ->limit(20)
                    ->searchable(),
            ]);
    }
}
