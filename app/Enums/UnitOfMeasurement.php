<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UnitOfMeasurement: string implements HasLabel
{
    // Unidades de masa (peso)
    case MILLIGRAM = 'mg';
    case GRAM = 'g';
    case KILOGRAM = 'kg';
    case OUNCE = 'oz';
    case POUND = 'lb';
    case TON = 't'; // Tonelada métrica
    case SHORT_TON = 'ton_us'; // Tonelada corta (US) - clave más consistente
    case LONG_TON = 'ton_uk';  // Tonelada larga (UK) - clave más consistente

    // Unidades de volumen (líquidos)
    case MILLILITER = 'ml';
    case LITER = 'l';
    case FLUID_OUNCE = 'fl_oz'; // Clave más consistente
    case CUP = 'cup';
    case PINT = 'pt';
    case QUART = 'qt';
    case GALLON = 'gal';
    case TEASPOON = 'tsp';
    case TABLESPOON = 'tbsp';

    // Unidades de longitud
    case MILLIMETER = 'mm';
    case CENTIMETER = 'cm';
    case METER = 'm';
    case KILOMETER = 'km';
    case INCH = 'in';
    case FOOT = 'ft';
    case YARD = 'yd';
    case MILE = 'mi';

    // Unidades de área
    case SQUARE_MILLIMETER = 'mm2'; // Clave más consistente
    case SQUARE_CENTIMETER = 'cm2'; // Clave más consistente
    case SQUARE_METER = 'm2';     // Clave más consistente
    case SQUARE_KILOMETER = 'km2'; // Clave más consistente
    case SQUARE_INCH = 'in2';     // Clave más consistente
    case SQUARE_FOOT = 'ft2';     // Clave más consistente
    case SQUARE_YARD = 'yd2';     // Clave más consistente
    case ACRE = 'acre';
    case HECTARE = 'ha';

    // Unidades de volumen (sólidos)
    case CUBIC_MILLIMETER = 'mm3'; // Clave más consistente
    case CUBIC_CENTIMETER = 'cm3'; // Clave más consistente
    case CUBIC_METER = 'm3';     // Clave más consistente
    case CUBIC_INCH = 'in3';     // Clave más consistente
    case CUBIC_FOOT = 'ft3';     // Clave más consistente
    case CUBIC_YARD = 'yd3';     // Clave más consistente

    // Unidades de conteo
    case UNIT = 'unit';
    case PIECE = 'pc';
    case DOZEN = 'doz';
    case GROSS = 'gross'; // Gruesa (144 unidades)

    // Unidades diversas (contenedores, etc.)
    case BOTTLE = 'bottle';
    case CAN = 'can';
    case JAR = 'jar';
    case BOX = 'box';
    case PACKAGE = 'pkg';
    case BAG = 'bag';

    public function getLabel(): ?string
    {
        return __("enums.unit_of_measurement.{$this->value}");
    }
}
