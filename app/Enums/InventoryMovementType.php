<?php

namespace App\Enums;

enum InventoryMovementType: string
{
    case ENTRY = 'Entry';
    case EXIT = 'Exit';
    case ADJUSTMENT = 'Adjustment';
}