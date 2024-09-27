<?php

namespace App\Filament\Resources\Menus;

use App\Enums\MenuStatus;
use App\Enums\MenuType;
use App\Filament\Resources\Menus\MenuResource\Pages;
use App\Filament\Resources\Menus\MenuResource\RelationManagers;
use App\Models\Menus\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;
 
    public static function form(Form $form): Form 
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label(__('models.title'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description')
                    ->columnSpanFull()
                    ->label(__('models.description')),
                Forms\Components\TextInput::make('menu_code')
                    ->maxLength(255)
                    ->label(__('models.menu_code')),
                Forms\Components\Select::make('menu_status')
                    ->options(self::getMenuStatus())
                    ->default('Active')
                    ->searchable()
                    ->label(__('models.menu_status')),
                Forms\Components\Select::make('menu_type')
                    ->options(self::getMenuType())
                    ->searchable()
                    ->default('Special')
                    ->label(__('models.menu_type')),
                Forms\Components\Toggle::make('is_recurring')
                    ->label(__('models.is_recurring')),
                Forms\Components\DateTimePicker::make('initial_date')
                    ->label(__('models.initial_date')),
                Forms\Components\DateTimePicker::make('final_date')
                    ->label(__('models.final_date')),
                Forms\Components\TextInput::make('menu_availability')
                    ->maxLength(255)
                    ->label(__('models.menu_availability')),
                Forms\Components\TextInput::make('portions')
                    ->required()
                    ->label(__('models.portions'))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label(__('models.title')),
                Tables\Columns\TextColumn::make('menu_code')
                    ->searchable()
                    ->label(__('models.menu_code')),
                Tables\Columns\TextColumn::make('menu_status')
                    ->label(__('models.menu_status')),
                Tables\Columns\TextColumn::make('menu_type')
                    ->label(__('models.menu_type')),
                Tables\Columns\IconColumn::make('is_recurring')
                    ->boolean()
                    ->label(__('models.is_recurring')),
                Tables\Columns\TextColumn::make('initial_date')
                    ->dateTime()
                    ->label(__('models.initial_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('final_date')
                    ->dateTime()
                    ->label(__('models.final_date'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('menu_availability')
                    ->searchable()
                    ->label(__('models.menu_availability')),
                Tables\Columns\TextColumn::make('portions')
                    ->searchable()
                    ->label(__('models.portions')),
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

    public static function getMenuStatus(): array
    {
        return array_map(fn($case) => $case->value, MenuStatus::cases());
    }

    public static function getMenuType(): array
    {
        return array_map(fn($case) => $case->value, MenuType::cases());
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.menus');
    }
 
    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.menus');
    }
}
