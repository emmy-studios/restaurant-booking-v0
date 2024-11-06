<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Roles;
use App\Enums\NotificationType;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label(__('models.user')),
                Forms\Components\Select::make('role')
                    ->options(Roles::class)
                    ->default('Customer')
                    ->required()
                    ->searchable()
                    ->label(__('models.role')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->label(__('models.title'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('message')
                    ->required()
                    ->label(__('models.message'))
                    ->columnSpanFull(),
                Forms\Components\Select::make('notification_type')
                    ->options(NotificationType::class)
                    ->default('Information')
                    ->searchable()
                    ->required()
                    ->label(__('models.notification_type')),
                Forms\Components\Toggle::make('is_read')
                    ->required()
                    ->label(__('models.is_read')),
                Forms\Components\TextInput::make('data')
                    ->label(__('models.data'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('redirect_url')
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label(__('models.redirect_url')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('models.user'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('models.role'))
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('models.title')),
                Tables\Columns\TextColumn::make('notification_type')
                    ->label(__('models.notification_type'))
                    ->searchable()
                    ->badge()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_read')
                    ->boolean()
                    ->label(__('models.is_read')),
                Tables\Columns\TextColumn::make('redirect_url')
                    ->searchable()
                    ->label(__('models.redirect_url')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.created_at'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('models.updated_at'))
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
