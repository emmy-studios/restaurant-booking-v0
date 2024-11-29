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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
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
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label(__('models.employee'))
                    ->required(),
                DatePicker::make('overtime_date')
                    ->required()
                    ->label(__('models.overtime_date')),
                TimePicker::make('start_time')
                    ->required()
                    ->label(__('models.start_time')),
                TimePicker::make('end_time')
                    ->required()
                    ->label(__('models.end_time')),
                TextInput::make('number_of_hours')
                    ->required()
                    ->label(__('models.number_of_hours'))
                    ->numeric(),
                MarkdownEditor::make('reason')
                    ->columnSpanFull()
                    ->label(__('models.reason')),
                Select::make('status')
                    ->options(OvertimeStatus::class)
                    ->searchable()
                    ->label(__('models.status'))
                    ->required(),
                Select::make('overtime_type')
                    ->options(OvertimeType::class)
                    ->searchable()
                    ->label(__('models.overtime_type'))
                    ->required(),
                Select::make('approved_by')
                    ->relationship('approver', 'name')
                    ->required()
                    ->label(__('models.approved_by')),
                MarkdownEditor::make('approver_comment')
                    ->label(__('models.approver_comment'))
                    ->columnSpanFull(),
                Select::make('payment_method')
                    ->options(PaymentMethod::class)
                    ->searchable()
                    ->label(__('models.payment_method'))
                    ->required(),
                Select::make('payment_currency')
                    ->options(CurrencySymbol::class)
                    ->searchable()
                    ->label(__('models.payment_currency'))
                    ->default('USD $')
                    ->required(),
                TextInput::make('hourly_rate')
                    ->numeric()
                    ->label(__('models.hourly_rate')),
                TextInput::make('total_payment')
                    ->numeric()
                    ->label(__('models.total_payment')),
                Toggle::make('is_paid')
                    ->label(__('models.is_paid?')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_id')
                    ->icon('heroicon-o-user-circle')
                    ->iconColor('success')
                    ->label(__('models.employee'))
                    ->sortable(),
                TextColumn::make('overtime_date')
                    ->icon('heroicon-o-calendar')
                    ->iconColor('info')
                    ->date()
                    ->label(__('models.overtime_date'))
                    ->sortable(),
                TextColumn::make('start_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('primary')
                    ->label(__('models.start_time')),
                TextColumn::make('end_time')
                    ->icon('heroicon-o-clock')
                    ->iconColor('primary')
                    ->label(__('models.end_time')),
                TextColumn::make('number_of_hours')
                    ->numeric()
                    ->label(__('models.number_of_hours'))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->label(__('models.status')),
                TextColumn::make('overtime_type')
                    ->badge()
                    ->label(__('models.overtime_type'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('approved_by')
                    ->numeric()
                    ->label(__('models.approved_by'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('approver_comment')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->iconColor('gray')
                    ->label(__('models.approver_comment'))
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_method')
                    ->badge()
                    ->label(__('models.payment_method'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_currency')
                    ->badge()
                    ->label(__('models.payment_currency'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('hourly_rate')
                    ->numeric()
                    ->label(__('models.hourly_rate'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_payment')
                    ->numeric()
                    ->label(__('models.total_payment'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('is_paid')
                    ->label(__('models.is_paid?'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
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
