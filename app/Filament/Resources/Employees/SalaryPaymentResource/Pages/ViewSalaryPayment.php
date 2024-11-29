<?php

namespace App\Filament\Resources\Employees\SalaryPaymentResource\Pages;

use App\Filament\Resources\Employees\SalaryPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSalaryPayment extends ViewRecord
{
    protected static string $resource = SalaryPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.view_payment');
    }
}
