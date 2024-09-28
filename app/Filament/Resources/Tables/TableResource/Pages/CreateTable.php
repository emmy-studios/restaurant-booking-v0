<?php

namespace App\Filament\Resources\Tables\TableResource\Pages;

use App\Filament\Resources\Tables\TableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTable extends CreateRecord
{
    protected static string $resource = TableResource::class;
}
