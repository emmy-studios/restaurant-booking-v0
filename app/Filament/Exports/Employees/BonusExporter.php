<?php

namespace App\Filament\Exports\Employees;

use App\Models\Employees\Bonus;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class BonusExporter extends Exporter
{
    protected static ?string $model = Bonus::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('currency_symbol')
                ->label(__('models.currency')),
            ExportColumn::make('amount')
                ->label(__('models.amount')),
            ExportColumn::make('type')
                ->label(__('models.type')),
            ExportColumn::make('description')
                ->label(__('models.description')),
            ExportColumn::make('date_awarded')
                ->label(__('models.date_awarded')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your bonus export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
