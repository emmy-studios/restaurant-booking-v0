<?php

namespace App\Filament\Resources\Events;

use App\Enums\CurrencyCode;
use App\Enums\CurrencySymbol;
use App\Filament\Resources\Events\EventPackageResource\Pages;
use App\Filament\Resources\Events\EventPackageResource\RelationManagers;
use App\Models\Events\EventPackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventPackageResource extends Resource
{
    protected static ?string $model = EventPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift-top';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 5;

    public static function getBreadcrumb(): string
    {
        return __('models.packages');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('package_name')
                            ->required()
                            ->label(__('models.package_name'))
                            ->maxLength(255),
                        MarkdownEditor::make('details')
                            ->columnSpanFull()
                            ->label(__('models.details')),
                    ]),
                    Section::make([
                        Select::make('currency_symbol')
                            ->options(self::getCurrencySymbol())
                            ->searchable()
                            ->default('USD $')
                            ->required()
                            ->label(__('models.currency_symbol')),
                        TextInput::make('subtotal')
                            ->numeric()
                            ->default(0)
                            ->label(__('models.subtotal')),
                        TextInput::make('total')
                            ->numeric()
                            ->default(0)
                            ->label(__('models.total')),
                    ]),
                ])
                    ->columnSpanFull()
                    ->from('md'),
                Section::make([
                    MarkdownEditor::make('additional_details')
                        ->columnSpanFull()
                        ->label(__('models.additional_details')),
                    MarkdownEditor::make('notes')
                        ->columnSpanFull()
                        ->label(__('models.notes'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package_name')
                    ->searchable()
                    ->label(__('models.package_name')),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label(__('models.currency_symbol')),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->label(__('models.subtotal'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label(__('models.total'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models.updated_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                ])->tooltip(__('panels.actions'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getCurrencySymbol(): array
    {
        return array_map(fn($case) => $case->value, CurrencySymbol::cases());
    }

    public static function getCurrencyCode(): array
    {
        return array_map(fn($case) => $case->value, CurrencyCode::cases());
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
            'index' => Pages\ListEventPackages::route('/'),
            'create' => Pages\CreateEventPackage::route('/create'),
            'view' => Pages\ViewEventPackage::route('/{record}'),
            'edit' => Pages\EditEventPackage::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.event_packages');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.events');
    }
}
