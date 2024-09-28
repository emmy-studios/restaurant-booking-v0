<?php

namespace App\Filament\Resources\NoticeResource\Pages;

use App\Filament\Resources\NoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotice extends EditRecord
{
    protected static string $resource = NoticeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.edit_notice');
    }
}
