<?php

namespace App\Filament\Resources\Returns;

use App\Enums\ReturnStatus;
use App\Filament\Resources\Returns\ReturnRequestResource\Pages;
use App\Filament\Resources\Returns\ReturnRequestResource\RelationManagers;
use App\Models\Returns\ReturnRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReturnRequestResource extends Resource
{
    protected static ?string $model = ReturnRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('models.returns');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('created_at', now()->toDateString())->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('order_code')
                            ->required()
                            ->label(__('models.order_code'))
                            ->maxLength(255),
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label(__('models.customer')),
                        Select::make('status')
                            ->options(ReturnStatus::class)
                            ->searchable()
                            ->default('Processing')
                            ->required()
                            ->label(__('models.status')),
                        Select::make('employee_id')
                            ->relationship('employee', 'name')
                            ->required()
                            ->label(__('models.responsable_employee')),
                    ]),
                    Section::make([
                        DateTimePicker::make('request_date')
                            ->required()
                            ->label(__('models.request_date')),
                        TextInput::make('quantity')
                            ->required()
                            ->label(__('models.quantity'))
                            ->numeric()
                            ->default(1)
                    ]),
                ])
                    ->columnSpanFull()
                    ->from('md'),
                Section::make([
                    TextInput::make('product_name')
                        ->required()
                        ->label(__('models.product_name'))
                        ->maxLength(255),
                    MarkdownEditor::make('reason')
                        ->required()
                        ->label(__('models.reason'))
                        ->columnSpanFull()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->searchable()
                    ->label(__('models.order_code')),
                TextColumn::make('product_name')
                    ->searchable()
                    ->sortable()
                    ->limit(10)
                    ->label(__('models.product_name')),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.customer_name'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('employee.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.responsable_employee'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('request_date')
                    ->dateTime()
                    ->searchable()
                    ->label(__('models.request_date'))
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->label(__('models.quantity'))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($record) => ReturnStatus::from($record->status)->getLabel())
                    ->color(fn ($record) => ReturnStatus::from($record->status)->getColor())
                    ->icon(fn ($record) => ReturnStatus::from($record->status)->getIcon())
                    ->searchable()
                    ->label(__('models.status')),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models.created_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('models.status'))
                    ->options([
                        collect(ReturnStatus::cases())
                            ->mapWithKeys(fn(ReturnStatus $status) => [$status->value => $status->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),
                Filter::make('date_applied')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('models.start_date')),
                        DatePicker::make('created_until')
                            ->label(__('models.end_date')),
    				])
                    ->query(function (Builder $query, array $data): Builder {
        				return $query
            				->when(
                				$data['created_from'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            				)
            				->when(
                				$data['created_until'],
                				fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
    				}),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
            ], position: ActionsPosition::BeforeColumns)
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
