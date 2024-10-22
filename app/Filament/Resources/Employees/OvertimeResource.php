<?php

namespace App\Filament\Resources\Employees;

use App\Enums\CurrencySymbol;
use App\Enums\OvertimeStatus;
use App\Enums\OvertimeType;
use App\Enums\PaymentMethod;
use App\Filament\Resources\Employees\OvertimeResource\Pages;
use App\Filament\Resources\Employees\OvertimeResource\RelationManagers;
use App\Models\Employees\Overtime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OvertimeResource extends Resource
{
    protected static ?string $model = Overtime::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-minus';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 8; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('overtime_date')
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->required(),
                Forms\Components\TextInput::make('number_of_hours')
                    ->required()
                    ->numeric(),
                Forms\Components\MarkdownEditor::make('reason')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(OvertimeStatus::class)
                    ->searchable()
                    ->label(__('models.status')) 
                    ->required(),
                Forms\Components\Select::make('overtime_type')
                    ->options(OvertimeType::class)
                    ->searchable()
                    ->required(), 
                Forms\Components\Select::make('approved_by')
                    ->relationship('approver', 'name')
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('payment_currency')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->default('USD $')
                    ->required(),
                Forms\Components\TextInput::make('hourly_rate')
                    ->numeric(),
                Forms\Components\TextInput::make('total_payment')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('overtime_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
                Tables\Columns\TextColumn::make('number_of_hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                Tables\Columns\TextColumn::make('overtime_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_currency')
                    ->badge(),
                Tables\Columns\TextColumn::make('hourly_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_payment')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListOvertimes::route('/'),
            'create' => Pages\CreateOvertime::route('/create'),
            'view' => Pages\ViewOvertime::route('/{record}'),
            'edit' => Pages\EditOvertime::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    { 
        return __('models.overtimes');
    }
 
    // Translate Navigation Group. 
    public static function getNavigationGroup(): string
    {
        return __('models.employees');
    }
}
