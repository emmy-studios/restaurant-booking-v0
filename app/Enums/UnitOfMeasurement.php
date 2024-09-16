<?php

namespace App\Enums;

enum UnitOfMeasurement: string
{
    case LITERS = 'L';
    case MILLILITERS = 'mL';
    case GRAMS = 'g';
    case KILOGRAMS = 'kg';
    case OUNCES = 'oz';
    case POUNDS = 'lb';
    case UNITS = 'unit';
    case PIECES = 'pcs';
    case CUBIC_CENTIMETERS = 'cm3';
    case CUBIC_METERS = 'm3';
    case CENTIMETERS = 'cm';
    case METERS = 'm';
}
