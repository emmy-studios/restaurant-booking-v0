<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\UserNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Roles;
use App\Enums\NotificationType;

class NotificationResource extends Resource
{
    protected static ?string $model = UserNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label(__('models.user')),
                        Select::make('role')
                            ->options(Roles::class)
                            ->default('Customer')
                            ->required()
                            ->searchable()
                            ->label(__('models.role')),
                    ]),
                    Section::make([
                        Select::make('notification_type')
                            ->options(NotificationType::class)
                            ->default('Information')
                            ->searchable()
                            ->required()
                            ->label(__('models.notification_type')),
                        Toggle::make('is_read')
                            ->required()
                            ->label(__('models.is_read')),
                    ]),
                ])
                    ->columnSpanFull()
                    ->from('md'),
                Section::make([
                    TextInput::make('title')
                        ->required()
                        ->columnSpanFull()
                        ->label(__('models.title'))
                        ->maxLength(255),
                    MarkdownEditor::make('message')
                        ->required()
                        ->label(__('models.message'))
                        ->columnSpanFull(),
                    TextInput::make('data')
                        ->label(__('models.data'))
                        ->columnSpanFull(),
                    TextInput::make('redirect_url')
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->label(__('models.redirect_url'))
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('models.user'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('role')
                    ->label(__('models.role'))
                    ->sortable()
                    ->badge()
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable()
                    ->limit(15)
                    ->label(__('models.title')),
                TextColumn::make('notification_type')
                    ->label(__('models.notification_type'))
                    ->searchable()
                    ->badge()
                    ->sortable(),
                IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('models.is_read')),
                TextColumn::make('redirect_url')
                    ->searchable()
                    ->label(__('models.redirect_url'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.updated_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'view' => Pages\ViewNotification::route('/{record}'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.notifications');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.users');
    }

}
