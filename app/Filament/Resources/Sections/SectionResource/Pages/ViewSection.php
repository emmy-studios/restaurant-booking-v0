<?php

namespace App\Filament\Resources\Sections\SectionResource\Pages;

use App\Filament\Resources\Sections\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSection extends ViewRecord
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    } 

    public function getTitle(): string 
    {
        return __('models.view_section');
    }
}
