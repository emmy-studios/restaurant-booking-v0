<?php

namespace App\Filament\Resources\Employees;

use App\Enums\AccountType;
use App\Enums\ContractType;
use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\EmployeeStatus;
use App\Enums\Roles;
use App\Filament\Resources\Employees\EmployeeResource\Pages;
use App\Filament\Resources\Employees\EmployeeResource\RelationManagers;
use App\Models\Employees\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('models.name')) 
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->label(__('models.first_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255)
                    ->label(__('models.last_name')),
                Forms\Components\TextInput::make('identification_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('id_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('phone_code')
                    ->options(CountryCode::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->options(Countries::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('postal_code')
                    ->maxLength(255), 
                Forms\Components\MarkdownEditor::make('address')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date_of_birth'),
                Forms\Components\DatePicker::make('hire_date'),
                Forms\Components\TextInput::make('social_security_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('department')
                    ->maxLength(255),
                Forms\Components\Select::make('contract_type')
                    ->options(ContractType::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('secondary_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('emergency_contact_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('emergency_contact_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Toggle::make('work_permit')
                    ->required(),
                Forms\Components\TextInput::make('tax_id_number')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options(EmployeeStatus::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('supervisor')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('fire_date'),
                Forms\Components\DatePicker::make('termination_date'),
                Forms\Components\DatePicker::make('last_promotion_date'),
                Forms\Components\DatePicker::make('last_promotion_role'),
                Forms\Components\Select::make('role')
                    ->options(Roles::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('bank_name')
                    ->maxLength(255),
                Forms\Components\Select::make('account_type')
                    ->options(AccountType::class)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('account_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bank_code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('routing_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('iban')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(), 
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_code')
                    ->badge()
                    ->label(__('models.phone_code')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('social_security_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contract_type'),
                Tables\Columns\TextColumn::make('secondary_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact_phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('work_permit')
                    ->boolean(),
                Tables\Columns\TextColumn::make('tax_id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('supervisor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fire_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('termination_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_promotion_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_promotion_role')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->label(__('models.role')),
                Tables\Columns\TextColumn::make('bank_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_type'),
                Tables\Columns\TextColumn::make('bank_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('routing_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iban')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.employees');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }

}
