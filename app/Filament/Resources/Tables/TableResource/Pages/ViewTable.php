<?php

namespace App\Filament\Resources\Tables\TableResource\Pages;

use App\Filament\Resources\Tables\TableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTable extends ViewRecord
{
    protected static string $resource = TableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
