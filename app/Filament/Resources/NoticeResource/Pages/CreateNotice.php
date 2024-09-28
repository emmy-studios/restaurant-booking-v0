<?php

namespace App\Filament\Resources\NoticeResource\Pages;

use App\Filament\Resources\NoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNotice extends CreateRecord
{
    protected static string $resource = NoticeResource::class; 

    public function getTitle(): string
    {
        return __('models.create_notice');
    }
}
