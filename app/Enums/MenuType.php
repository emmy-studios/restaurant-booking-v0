<?php

namespace App\Enums;

enum MenuType: string
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
}
