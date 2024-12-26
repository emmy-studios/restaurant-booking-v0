<?php

namespace App\Filament\Resources;

use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\Gender;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use App\Enums\Roles;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('models.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('first_name')
                    ->label(__('models.first_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->label(__('models.last_name'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('identification_code')
                    ->label(__('models.identification_code'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('identification_number')
                    ->label(__('models.identification_number'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('models.email'))
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options(Gender::class)
                    ->label(__('models.gender'))
                    ->default('Other')
                    ->searchable(),
                Forms\Components\Select::make('country_code')
                    ->label(__('models.country_code'))
                    ->options(CountryCode::class)
                    ->searchable()
                    ->default('+506'),
                Forms\Components\TextInput::make('phone_number')
                    ->label(__('models.phone_number'))
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->label(__('models.country'))
                    ->options(Countries::class)
                    ->searchable()
                    ->default('Costa Rica'),
                Forms\Components\TextInput::make('postal_code')
                    ->label(__('models.postal_code'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->label(__('models.city'))
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('address')
                    ->label(__('models.address'))
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(__('models.email_verified_at')),
                Forms\Components\TextInput::make('password')
                    ->label(__('models.password'))
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->label(__('models.role'))
                    ->required()
                    //->options(USER::ROLES)
                    ->options(Roles::class)
                    ->default('CUSTOMER'),
                Forms\Components\FileUpload::make('image_url')
                    ->label(__('models.image_url'))
                    ->disk('public')
                    ->directory('users-image')
                    ->previewable(false)
                    ->image()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('models.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('models.first_name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->label(__('models.last_name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_code')
                    ->label(__('models.identification_code'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_number')
                    ->label(__('models.identification_number')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('models.email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('models.gender'))
                    ->badge(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->circular()
                    ->label(__('models.image_url')),
                Tables\Columns\TextColumn::make('country_code')
                    ->label(__('models.country_code')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('models.phone_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->sortable()
                    ->badge()
                    ->label(__('models.country'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label(__('models.postal_code'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label(__('models.city'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label(__('models.email_verified_at'))
                    ->dateTime()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('role')
                    ->label(__('models.role'))
                    ->sortable()
                    ->badge()
                    ->searchable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // Translate Navigation Label.
    public static function getNavigationLabel(): string
    {
        return __('models.users');
    }

    // Translate Navigation Group.
    public static function getNavigationGroup(): string
    {
        return __('models.users');
    }
}

