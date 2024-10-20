<?php

namespace App\Filament\Chef\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

use App\Models\Orders\Order;

class NewOrderTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_code')
                    ->label(__('models.order_code')),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('models.user'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->label(__('models.order_status'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency')),
                Tables\Columns\TextColumn::make('total')
                    ->label(__('models.total'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('models.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('models.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)

            ]);
    }
}
