<?php

namespace App\Enums;

enum InventoryStatus: string
{
    case ACTIVE = 'Active';
    case LOW_STOCK = 'Low Stock';
    case OUT_OF_STOCK = 'Out of Stock';
    case RESTOCKING = 'Restocking';
    case DISCONTINUED = 'Discontinued';
    case DAMAGED = 'Damaged';
    case PENDING_AUDIT = 'Pending Audit';
    case UNDER_REVIEW = 'Under Review';
    case RESERVED = 'Reserved';
}
