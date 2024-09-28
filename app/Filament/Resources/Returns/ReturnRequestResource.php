<?php

namespace App\Filament\Resources\Returns;

use App\Enums\ReturnStatus;
use App\Filament\Resources\Returns\ReturnRequestResource\Pages;
use App\Filament\Resources\Returns\ReturnRequestResource\RelationManagers;
use App\Models\Returns\ReturnRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturnRequestResource extends Resource
{
    protected static ?string $model = ReturnRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->required()
                    ->label(__('models.order_code'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('product_name') 
                    ->required()
                    ->label(__('models.product_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_name')
                    ->required()
                    ->label(__('models.customer_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('responsable_employee')
                    ->required()
                    ->label(__('models.responsable_employee'))
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('request_date')
                    ->required()
                    ->label(__('models.request_date')),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->label(__('models.quantity'))
                    ->numeric(),
                Forms\Components\MarkdownEditor::make('reason')
                    ->required()
                    ->label(__('models.reason'))
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options(self::getReturnStatus())
                    ->searchable()
                    ->default('Confirmed')
                    ->required()
                    ->label(__('models.status')),
            ]);
    } 

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')
                    ->searchable()
                    ->label(__('models.order_code')),
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable()
                    ->label(__('models.product_name')),
                Tables\Columns\TextColumn::make('customer_name')
                    ->searchable()
                    ->label(__('models.customer_name')),
                Tables\Columns\TextColumn::make('responsable_employee')
                    ->searchable()
                    ->label(__('models.responsable_employee')),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime()
                    ->label(__('models.request_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('models.status')),
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

    public static function getReturnStatus(): array
    {
        return array_map(fn($case) => $case->value, ReturnStatus::cases());
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
            'index' => Pages\ListReturnRequests::route('/'),
            'create' => Pages\CreateReturnRequest::route('/create'),
            'view' => Pages\ViewReturnRequest::route('/{record}'),
            'edit' => Pages\EditReturnRequest::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.returns');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.returns');
    }
}
