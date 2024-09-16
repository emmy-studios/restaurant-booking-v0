<?php

namespace App\Enums;

enum MenuStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case DRAFT = 'Draft';
    case ARCHIVED = 'Archived';
    case UNAVAILABLE = 'Unavailable';
}