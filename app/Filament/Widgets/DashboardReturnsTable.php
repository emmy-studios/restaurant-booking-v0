<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Returns\ReturnRequestResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardReturnsTable extends BaseWidget
{

    protected int | string |array $columnSpan = "full";
 
    protected function getTableHeading(): string
    {
        return __('models.returns');  
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(ReturnRequestResource::getEloquentQuery())
            ->defaultPaginationPageOption(6)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable()
                    ->label(__('models.order_code')),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable()
                    ->label(__('models.product_name')),
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable()
                    ->label(__('models.customer_name')),
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label(__('models.responsable_employee')),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime()
                    ->label(__('models.request_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
