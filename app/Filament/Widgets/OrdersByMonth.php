<?php

namespace App\Filament\Widgets;

use App\Models\Orders\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
 
class OrdersByMonth extends ChartWidget
{
    protected static ?string $heading = null;

    protected static string $color = 'success';

    protected static ?string $maxHeight = '300px';

    public function getDescription(): ?string
    {
        return __('panels.the_number_of_orders_made_per_month');
    }

    public function __construct()
    {
        static::$heading = __('panels.orders_by_month');
    }

    protected function getData(): array
    {

        $data = Trend::model(Order::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('panels.orders_by_month'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    //'backgroundColor' => '#36A2EB',
                    //'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }
}
 