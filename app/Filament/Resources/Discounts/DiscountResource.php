<?php

namespace App\Filament\Resources\Discounts;

use App\Filament\Resources\Discounts\DiscountResource\Pages;
use App\Filament\Resources\Discounts\DiscountResource\RelationManagers;
use App\Filament\Resources\Discounts\DiscountResource\RelationManagers\ProductsRelationManager;
use App\Models\Discounts\Discount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('discount_code')
                            ->label(__('models.discount_code'))
                            ->required()
                            ->default('DE-' . random_int(10000, 999999999)),
                        TextInput::make('discount_percentage')
                            ->label(__('models.discount_percentage'))
                            ->required()
                            ->numeric(),
                        DateTimePicker::make('start_at')
                            ->label(__('models.start_at'))
                            ->required(),
                        DateTimePicker::make('end_at')
                            ->label(__('models.end_at'))
                            ->required(),
                    ]),
                    Section::make([
                        FileUpload::make('banner_image')
                            ->label(__('models.banner_image'))
                            ->image(),
                    ]),
                ])
                    ->from('md')
                    ->columnSpanFull(),
                Section::make()
                    ->schema([
                        TextInput::make('banner_text')
                            ->columnSpanFull()
                            ->label(__('models.banner_text'))
                            ->maxLength(255),
                        MarkdownEditor::make('description')
                            ->label(__('models.description'))
                            ->columnSpanFull(),
                        MarkdownEditor::make('additional_details')
                            ->label(__('models.additional_details'))
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('discount_code')
                    ->label(__('models.discount_code'))
                    ->searchable(),
                TextColumn::make('discount_percentage')
                    ->label(__('models.discount_percentage'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_at')
                    ->label(__('models.start_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_at')
                    ->label(__('models.end_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('banner_text')
                    ->label(__('models.banner_text'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('banner_image')
                    ->label(__('models.banner_image'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('models.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('models.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                    ->tooltip(__('models.actions'))
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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'view' => Pages\ViewDiscount::route('/{record}'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.discounts');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.discounts');
    }
}
