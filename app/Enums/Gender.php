<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'Male';
    case FEMALE = 'Female';
    case NON_BINARY = 'Non-binary';
    case OTHER = 'Other';
    case PREFER_NOT_TO_SAY = 'Prefer not to say';
}