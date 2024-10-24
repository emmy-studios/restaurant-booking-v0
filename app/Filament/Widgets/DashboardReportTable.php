<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Reports\ReportResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardReportTable extends BaseWidget
{

    protected int | string |array $columnSpan = "full";

    protected function getTableHeading(): string
    {
        return __('models.reports');  
    }

    public function table(Table $table): Table
    { 
        return $table
            ->query(ReportResource::getEloquentQuery())
            ->defaultPaginationPageOption(6)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title') 
                    ->searchable()
                    ->sortable()
                    ->label(__('models.title')),
                Tables\Columns\TextColumn::make('report_type')
                    ->badge()
                    ->label(__('models.report_type'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.employee'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label(__('models.content')),
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
