<?php

namespace App\Filament\Chef\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;
use App\Models\Notice;

class NoticesTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Notice::where("user_id", Auth::id()),
            )
            ->actions([
                Tables\Actions\Action::make('viewDetails')
                    ->label(__('models.details'))
                    ->icon('heroicon-o-eye')
                    ->modalHeading(__('models.notice_details'))
                    ->modalContent(fn ($record) => view('filament.chef.pages.notice-modal', ['notice' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->color('primary'),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make("message")
                    ->label(__("models.message"))
                    ->searchable(),
                Tables\Columns\TextColumn::make("date")
                    ->label(__("models.date")),
            ]);
    }
}
