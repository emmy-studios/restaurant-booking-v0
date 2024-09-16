<?php

namespace App\Filament\Resources\Sections\SectionResource\Pages;

use App\Filament\Resources\Sections\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSections extends ListRecords
{
    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_section')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.section');
    }
}
