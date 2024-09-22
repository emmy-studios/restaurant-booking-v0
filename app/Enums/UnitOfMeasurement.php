<?php

namespace App\Enums;

enum UnitOfMeasurement: string
{
    // Volumen (líquidos)
    case LITERS = 'L';
    case MILLILITERS = 'mL';
    case GALLONS = 'gal';
    case QUARTS = 'qt';
    case PINTS = 'pt';
    case CUPS = 'cup';
    case FLUID_OUNCES = 'fl oz';
    case TEASPOONS = 'tsp';
    case TABLESPOONS = 'tbsp';

    // Peso (sólidos)
    case GRAMS = 'g';
    case KILOGRAMS = 'kg';
    case MILLIGRAMS = 'mg';
    case OUNCES = 'oz';
    case POUNDS = 'lb';
    case TONS = 't';

    // Longitud
    case CENTIMETERS = 'cm';
    case METERS = 'm';

    // Volumen sólido
    case CUBIC_CENTIMETERS = 'cm3';
    case CUBIC_METERS = 'm3';

    // Unidades
    case UNITS = 'unit';
    case PIECES = 'pcs';
    case DOZEN = 'dozen';
    case BOXES = 'box';
    case BOTTLES = 'bottle';
    case BUNCH = 'bunch';
    case SCOOPS = 'scoop';
    case JUGS = 'jug';

    // Superficie
    case SQUARE_METERS = 'm2';
    case SQUARE_CENTIMETERS = 'cm2';
}
