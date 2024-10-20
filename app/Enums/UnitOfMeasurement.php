<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UnitOfMeasurement: string implements HasLabel
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
    case SHOTS = 'shot';

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
    case INCHES = 'in';
    case FEET = 'ft';

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
    case PLATES = 'plate';
    case TRAYS = 'tray';
    case PORTIONS = 'portion';
    case GLASSES = 'glass';
    case PACKETS = 'packet';

    // Superficie
    case SQUARE_METERS = 'm2';
    case SQUARE_CENTIMETERS = 'cm2';
    case SQUARE_FEET = 'ft2';
    case ACRES = 'acre';

    public function getLabel(): ?string
    {
        return match ($this) {
            // Volumen (líquidos)
            self::LITERS => 'Liters',
            self::MILLILITERS => 'Milliliters',
            self::GALLONS => 'Gallons',
            self::QUARTS => 'Quarts',
            self::PINTS => 'Pints',
            self::CUPS => 'Cups',
            self::FLUID_OUNCES => 'Fluid Ounces',
            self::TEASPOONS => 'Teaspoons',
            self::TABLESPOONS => 'Tablespoons',
            self::SHOTS => 'Shots',

            // Peso (sólidos)
            self::GRAMS => 'Grams',
            self::KILOGRAMS => 'Kilograms',
            self::MILLIGRAMS => 'Milligrams',
            self::OUNCES => 'Ounces',
            self::POUNDS => 'Pounds',
            self::TONS => 'Tons',

            // Longitud
            self::CENTIMETERS => 'Centimeters',
            self::METERS => 'Meters',
            self::INCHES => 'Inches',
            self::FEET => 'Feet',

            // Volumen sólido
            self::CUBIC_CENTIMETERS => 'Cubic Centimeters',
            self::CUBIC_METERS => 'Cubic Meters',

            // Unidades
            self::UNITS => 'Units',
            self::PIECES => 'Pieces',
            self::DOZEN => 'Dozen',
            self::BOXES => 'Boxes',
            self::BOTTLES => 'Bottles',
            self::BUNCH => 'Bunch',
            self::SCOOPS => 'Scoops',
            self::JUGS => 'Jugs',
            self::PLATES => 'Plates',
            self::TRAYS => 'Trays',
            self::PORTIONS => 'Portions',
            self::GLASSES => 'Glasses',
            self::PACKETS => 'Packets',

            // Superficie
            self::SQUARE_METERS => 'Square Meters',
            self::SQUARE_CENTIMETERS => 'Square Centimeters',
            self::SQUARE_FEET => 'Square Feet',
            self::ACRES => 'Acres',
        };
    }
}
