<?php

namespace App\Filament\Chef\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Orders\OrderItem;

class NewOrderItemTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
            )
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('order.id')
                    ->label(__('models.order_code')),
                Tables\Columns\TextColumn::make('product_id')
                    ->label(__('models.product')),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('models.quantity')),
                Tables\Columns\TextColumn::make('total')
                    ->label(__('models.total'))
            ]);
    }
}
