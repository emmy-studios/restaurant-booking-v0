<?php

namespace App\Filament\Resources\Employees;

use App\Filament\Resources\Employees\SalaryPaymentResource\Pages;
use App\Filament\Resources\Employees\SalaryPaymentResource\RelationManagers;
use App\Models\Employees\SalaryPayment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\PaymentStatus;
use App\Enums\SalaryType;
use App\Enums\PaymentMethod;
use App\Enums\EmployeeConfirmation;
use App\Enums\CurrencySymbol;

class SalaryPaymentResource extends Resource
{
    protected static ?string $model = SalaryPayment::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 11;

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.salary_payments');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                Forms\Components\TextInput::make('payment_code')
                    ->required()
                    ->label(__('models.payment_code'))
                    ->maxLength(255),
                Forms\Components\DatePicker::make('payment_date')
                    ->required()
                    ->label(__('models.payment_date')),
                Forms\Components\Select::make('salary_type')
                    ->options(SalaryType::class)
                    ->searchable()
                    ->label(__('models.salary_type'))
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->searchable()
                    ->label(__('models.payment_method'))
                    ->required(),
                Forms\Components\Select::make('currency')
                    ->options(CurrencySymbol::class)
                    ->label(__('models.currency'))
                    ->default('USD $')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('base_salary')
                    ->required()
                    ->label(__('models.base_salary'))
                    ->numeric(),
                Forms\Components\TextInput::make('overtime_payment')
                    ->numeric()
                    ->label(__('models.overtime_payment')),
                Forms\Components\TextInput::make('bonus_payment')
                    ->numeric()
                    ->label(__('models.bonus_payment')),
                Forms\Components\TextInput::make('tax_deductions')
                    ->numeric()
                    ->label(__('models.tax_deductions')),
                Forms\Components\TextInput::make('insurance_deductions')
                    ->numeric()
                    ->label(__('models.insurance_deductions')),
                Forms\Components\TextInput::make('other_deductions')
                    ->numeric()
                    ->label(__('models.other_deductions')),
                Forms\Components\TextInput::make('deductions_total')
                    ->numeric()
                    ->label(__('models.deductions_total')),
                Forms\Components\TextInput::make('net_salary')
                    ->required()
                    ->numeric()
                    ->label(__('models.net_salary')),
                Forms\Components\TextInput::make('total_overtime_hours')
                    ->numeric()
                    ->label(__('models.total_overtime_hours')),
                Forms\Components\TextInput::make('total_absences')
                    ->numeric()
                    ->label(__('models.total_absences')),
                Forms\Components\TextInput::make('total_hours_worked')
                    ->numeric()
                    ->label(__('models.total_hours_worked')),
                Forms\Components\Select::make('payment_status')
                    ->options(PaymentStatus::class)
                    ->default('Pending')
                    ->searchable()
                    ->required()
                    ->label(__('models.payment_status')),
                Forms\Components\Select::make('employee_confirmation')
                    ->options(EmployeeConfirmation::class)
                    ->default('Pending')
                    ->searchable()
                    ->required()
                    ->label(__('models.employee_confirmation')),
                Forms\Components\Select::make('approved_by')
                    ->relationship('approver', 'name')
                    ->label(__('models.approved_by')),
                Forms\Components\MarkdownEditor::make('approver_comment')
                    ->columnSpanFull()
                    ->label(__('models.approver_comment')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->icon('heroicon-o-user-circle')
                    ->label(__('models.employee'))
                    ->iconColor('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_code')
                    ->searchable()
                    ->label(__('models.payment_code')),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->searchable()
                    ->label(__('models.payment_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('salary_type')
                    ->label(__('models.salary_type')),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('models.payment_method'))
                    ->icon('heroicon-o-credit-card')
                    ->iconColor('warning'),
                Tables\Columns\TextColumn::make('currency')
                    ->badge()
                    ->color('gray')
                    ->label(__('models.currency')),
                Tables\Columns\TextColumn::make('base_salary')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.base_salary')),
                Tables\Columns\TextColumn::make('overtime_payment')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.overtime_payment'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bonus_payment')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.bonus_payment'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tax_deductions')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.tax_deductions'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('insurance_deductions')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.insurance_deductions'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('other_deductions')
                    ->numeric()
                    ->label(__('models.other_deductions'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deductions_total')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.deductions_total'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('net_salary')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.net_salary'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_overtime_hours')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.total_overtime_hours'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_absences')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.total_absences'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_hours_worked')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.total_hours_worked'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->label(__('models.payment_status'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employee_confirmation')
                    ->label(__('models.employee_confirmation'))
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable()
                    ->label(__('models.approved_by'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.updated_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalaryPayments::route('/'),
            'create' => Pages\CreateSalaryPayment::route('/create'),
            'view' => Pages\ViewSalaryPayment::route('/{record}'),
            'edit' => Pages\EditSalaryPayment::route('/{record}/edit'),
        ];
    }
}
