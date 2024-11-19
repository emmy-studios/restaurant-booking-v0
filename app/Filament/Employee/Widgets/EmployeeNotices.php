<?php

namespace App\Filament\Employee\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Notice;

class EmployeeNotices extends BaseWidget
{
    protected function getTableHeading(): string
    {
        return __('panels.employee_notices');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Notice::where("user_id", Auth::id()),
            )
            ->actions([
                Action::make('viewDetails')
                    ->label(__('models.details'))
                    ->icon('heroicon-o-eye')
                    ->modalHeading(__('panels.notice_details'))
                    ->modalContent(fn ($record) => view('filament.employee.pages.components.notice-modal',
                        [
                            'notice' => $record,
                        ])
                    )
                    ->action(function (Notice $record) {
                        $record->update(['is_read' => 1]);
                        $record->save();
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->color('primary')

            ])
            ->columns([
                Tables\Columns\TextColumn::make("type")
                    ->label(__("models.type"))
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make("subject")
                    ->label(__("models.subject"))
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make("message")
                    ->label(__("models.message"))
                    ->searchable()
                    ->limit(30),
                Tables\Columns\IconColumn::make("is_read")
                    ->boolean()
                    ->label(__('models.is_read')),
                Tables\Columns\TextColumn::make("date")
                    ->label(__("models.date")),
            ]);
    }
}
