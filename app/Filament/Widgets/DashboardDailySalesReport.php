<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Reports\DailySaleReportResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardDailySalesReport extends BaseWidget
{

    protected int | string |array $columnSpan = "full";
 
    protected function getTableHeading(): string
    {
        return __('models.daily_sale_reports');  
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(DailySaleReportResource::getEloquentQuery())
            ->defaultPaginationPageOption(6)
            ->defaultSort('created_at', 'desc') 
            ->columns([
                Tables\Columns\TextColumn::make('report_date')
                    ->dateTime()
                    ->label(__('models.report_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_orders')
                    ->numeric()
                    ->label(__('models.total_orders'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_sales')
                    ->numeric()
                    ->label(__('models.total_sales'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label(__('models.currency_code')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->label(__('models.total_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_discounts')
                    ->numeric()
                    ->label(__('models.total_discounts'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_net_amount')
                    ->numeric()
                    ->label(__('models.total_net_amount'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label(__('models.employee'))
                    ->sortable(),
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
