<?php

namespace App\Filament\Exports\Employees;

use App\Models\Employees\Overtime;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OvertimeExporter extends Exporter
{
    protected static ?string $model = Overtime::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('employee.name')
                ->label(__('models.employee')),
            ExportColumn::make('overtime_date')
                ->label(__('models.overtime_date')),
            ExportColumn::make('start_time')
                ->label(__('models.start_time')),
            ExportColumn::make('end_time')
                ->label(__('models.end_time')),
            ExportColumn::make('number_of_hours')
                ->label(__('models.number_of_hours')),
            ExportColumn::make('reason')
                ->label(__('models.reason')),
            ExportColumn::make('status')
                ->label(__('models.status')),
            ExportColumn::make('overtime_type')
                ->label(__('models.overtime_type')),
            ExportColumn::make('approved_by')
                ->label(__('models.approved_by')),
            ExportColumn::make('approver_comment')
                ->label(__('models.approver_comment')),
            ExportColumn::make('payment_method')
                ->label(__('models.payment_method')),
            ExportColumn::make('payment_currency')
                ->label(__('models.payment_currency')),
            ExportColumn::make('hourly_rate')
                ->label(__('models.hourly_rate')),
            ExportColumn::make('total_payment')
                ->label(__('models.total_payment')),
            ExportColumn::make('is_paid')
                ->label(__('models.is_paid')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your overtime export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
