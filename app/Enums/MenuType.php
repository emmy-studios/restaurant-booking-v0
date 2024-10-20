<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MenuType: string implements HasLabel
{
    case BREAKFAST = 'Breakfast';
    case LUNCH = 'Lunch';
    case DINNER = 'Dinner';
    case SPECIAL = 'Special';
    case BRUNCH = 'Brunch';
    case SEASONAL = 'Seasonal';
    case KIDS = 'Kids';
    case DRINKS = 'Drinks';
    case DESSERTS = 'Desserts';

    public function getLabel(): ?string
    {
        return $this->value;
    }

}
