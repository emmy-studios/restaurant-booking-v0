<?php

namespace App\Filament\Resources\Employees\SalaryPaymentResource\Pages;

use App\Filament\Resources\Employees\SalaryPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalaryPayment extends EditRecord
{
    protected static string $resource = SalaryPaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return __('models.edit_payment');
    }

}
