<?php

namespace App\Filament\Widgets;

use App\Models\Sales\Sale;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SalesLineChart extends ChartWidget
{
    protected static ?string $heading = null;

    protected static string $color = 'danger';

    protected static ?string $maxHeight = '300px';

    public function __construct()
    {
        static::$heading = __('panels.sales_per_month'); 
    }

    protected function getData(): array
    {

        $data = Trend::model(Sale::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('panels.sales_per_month'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
