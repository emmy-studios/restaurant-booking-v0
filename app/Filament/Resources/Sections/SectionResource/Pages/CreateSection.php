<?php

namespace App\Filament\Resources\Sections\SectionResource\Pages;

use App\Filament\Resources\Sections\SectionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSection extends CreateRecord
{
    protected static string $resource = SectionResource::class;

    public function getTitle(): string
    {
        return __('models.create_section');
    }

}
 