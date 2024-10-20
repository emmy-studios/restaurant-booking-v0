<?php

namespace App\Filament\Resources;

use App\Enums\NoticesType;
use App\Filament\Resources\NoticeResource\Pages;
use App\Filament\Resources\NoticeResource\RelationManagers;
use App\Models\Notice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoticeResource extends Resource
{
    protected static ?string $model = Notice::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label(__('models.user'))
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options(NoticesType::class)
                    ->searchable()
                    ->default('Information')
                    ->required()
                    ->label(__('models.type')),
                Forms\Components\TextInput::make('subject')
                    ->maxLength(255)
                    ->label(__('models.subject')),
                Forms\Components\MarkdownEditor::make('message')
                    ->columnSpanFull()
                    ->label(__('models.message')),
                Forms\Components\DateTimePicker::make('date')
                    ->required()
                    ->label(__('models.date')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label(__('models.user'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->label(__('models.type')),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->label(__('models.subject')),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->label(__('models.date'))
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
    /*
    public static function getNoticeType(): array
    {
        return array_map(fn($case) => $case->value, NoticesType::cases());
    } */

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotices::route('/'),
            'create' => Pages\CreateNotice::route('/create'),
            'view' => Pages\ViewNotice::route('/{record}'),
            'edit' => Pages\EditNotice::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.notices');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.users');
    }
}
