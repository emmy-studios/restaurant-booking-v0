<?php

namespace App\Filament\Exports\Employees;

use App\Models\Employees\Attendance;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AttendanceExporter extends Exporter
{
    protected static ?string $model = Attendance::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('employee.name')
                ->label(__('models.employee')),
            ExportColumn::make('date')
                ->label(__('models.date')),
            ExportColumn::make('check_in_time')
                ->label(__('models.check_in_time')),
            ExportColumn::make('check_out_time')
                ->label(__('models.check_out_time')),
            ExportColumn::make('total_work_hours')
                ->label(__('models.total_work_hours')),
            ExportColumn::make('break_start_time')
                ->label(__('models.break_start_time')),
            ExportColumn::make('break_end_time')
                ->label(__('models.break_end_time')),
            ExportColumn::make('lunch_break_duration')
                ->label(__('models.lunch_break_duration')),
            ExportColumn::make('is_holiday')
                ->label(__('models.is_holiday')),
            ExportColumn::make('is_weekend')
                ->label(__('models.is_weekend')),
            ExportColumn::make('notes')
                ->label(__('models.notes'))
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your attendance export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
