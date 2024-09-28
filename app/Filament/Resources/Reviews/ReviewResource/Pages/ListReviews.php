<?php

namespace App\Filament\Resources\Reviews\ReviewResource\Pages;

use App\Filament\Resources\Reviews\ReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__('models.create_review')),
        ];
    } 

    public function getTitle(): string
    {
        return __('models.reviews');
    } 
}
