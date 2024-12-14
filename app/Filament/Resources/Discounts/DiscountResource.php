<?php

namespace App\Filament\Resources\Discounts;

use App\Filament\Resources\Discounts\DiscountResource\Pages;
use App\Filament\Resources\Discounts\DiscountResource\RelationManagers;
use App\Filament\Resources\Discounts\DiscountResource\RelationManagers\ProductsRelationManager;
use App\Models\Discounts\Discount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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
                Forms\Components\TextInput::make('discount_code')
                    ->label(__('models.discount_code'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('discount_percentage')
                    ->label(__('models.discount_percentage'))
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('start_at')
                    ->label(__('models.start_at'))
                    ->required(),
                Forms\Components\DateTimePicker::make('end_at')
                    ->label(__('models.end_at'))
                    ->required(),
                Forms\Components\TextInput::make('banner_text')
                    ->columnSpanFull()
                    ->label(__('models.banner_text'))
                    ->maxLength(255),
                Forms\Components\FileUpload::make('banner_image')
                    ->label(__('models.banner_image'))
                    ->image(),
                Forms\Components\MarkdownEditor::make('description')
                    ->label(__('models.description'))
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('additional_details')
                    ->label(__('models.additional_details'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('discount_code')
                    ->label(__('models.discount_code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount_percentage')
                    ->label(__('models.discount_percentage'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_at')
                    ->label(__('models.start_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->label(__('models.end_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('banner_text')
                    ->label(__('models.banner_text'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('banner_image')
                    ->label(__('models.banner_image')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('models.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('models.updated_at'))
                    ->dateTime()
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
