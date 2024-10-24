<?php

namespace App\Filament\Widgets;

use App\Models\Reservations\Reservation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ReservationsPerMonth extends ChartWidget
{
    protected static ?string $heading = null;

    protected static string $color = 'primary';

    protected static ?string $maxHeight = '300px';

    public function __construct()
    {
        static::$heading = __('panels.reservations_per_month');
    }

    protected function getData(): array
    {

        $data = Trend::model(Reservation::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('panels.reservations_per_month'),
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
