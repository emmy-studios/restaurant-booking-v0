<?php

namespace App\Filament\Resources\Employees\AttendanceResource\Pages;

use App\Filament\Resources\Employees\AttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAttendance extends CreateRecord
{
    protected static string $resource = AttendanceResource::class;
}
