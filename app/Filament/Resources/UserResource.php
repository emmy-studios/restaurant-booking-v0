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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use App\Enums\Roles;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $activeNavigationIcon = 'heroicon-o-check-badge';

    protected static ?string $navigationLabel = null;

    protected static ?string $navigationGroup = null;

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('models.users');
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
                    Section::make()
                        ->icon('heroicon-o-user-plus')
                        ->schema([
                            TextInput::make('name')
                                ->label(__('models.username'))
                                ->required()
                                ->maxLength(255),
                            TextInput::make('identification_code')
                                ->label(__('models.identification_code'))
                                ->maxLength(255),
                            TextInput::make('first_name')
                                ->label(__('models.first_name'))
                                ->maxLength(255),
                            TextInput::make('last_name')
                                ->label(__('models.last_name'))
                                ->maxLength(255),
                        ]),
                    Section::make([
                        FileUpload::make('image_url')
                            ->label(__('models.image_url'))
                            ->disk('public')
                            ->directory('users-image')
                            ->previewable(false)
                            ->image(),
                        DateTimePicker::make('email_verified_at')
                            ->label(__('models.email_verified_at')),
                        TextInput::make('password')
                            ->label(__('models.password'))
                            ->password()
                            ->required()
                            ->maxLength(255),
                    ])
                        ->icon('heroicon-o-photo'),
                ])
                    ->columnSpanFull()
                    ->from('md'),
                Section::make()
                    ->icon('heroicon-o-identification')
                    ->schema([
                        TextInput::make('identification_number')
                            ->label(__('models.identification_number'))
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label(__('models.email'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Select::make('gender')
                            ->options(Gender::class)
                            ->label(__('models.gender'))
                            ->default('Other')
                            ->searchable(),
                        DatePicker::make('birth')
                            ->label(__('models.birthday')),
                        Select::make('role')
                            ->label(__('models.role'))
                            ->required()
                            ->options(Roles::class),
                            //->default('CUSTOMER'),
                    ])
                    ->columns(2),
                Section::make()
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Select::make('country')
                            ->label(__('models.country'))
                            ->options(Countries::class)
                            ->searchable()
                            ->default('Costa Rica'),
                        TextInput::make('city')
                            ->label(__('models.city'))
                            ->maxLength(255),
                        Select::make('country_code')
                            ->label(__('models.country_code'))
                            ->options(CountryCode::class)
                            ->searchable()
                            ->default('+506'),
                        TextInput::make('phone_number')
                            ->label(__('models.phone_number'))
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('postal_code')
                            ->label(__('models.postal_code'))
                            ->maxLength(255)
                            ->columnSpanFull(),
                        MarkdownEditor::make('address')
                            ->label(__('models.address'))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('models.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('role')
                    ->label(__('models.role'))
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn ($record) => Roles::from($record->role)->getLabel())
                    ->color(fn ($record) => Roles::from($record->role)->getColor())
                    ->icon(fn ($record) => Roles::from($record->role)->getIcon())
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->circular()
                    ->label(__('models.image_url'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('first_name')
                    ->label(__('models.first_name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name')
                    ->sortable()
                    ->label(__('models.last_name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('identification_code')
                    ->label(__('models.identification_code'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('identification_number')
                    ->label(__('models.identification_number'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->label(__('models.email'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gender')
                    ->label(__('models.gender'))
                    ->badge()
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('country_code')
                    ->label(__('models.country_code'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone_number')
                    ->label(__('models.phone_number'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('country')
                    ->sortable()
                    ->badge()
                    ->label(__('models.country'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('postal_code')
                    ->label(__('models.postal_code'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city')
                    ->label(__('models.city'))
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email_verified_at')
                    ->label(__('models.email_verified_at'))
                    ->dateTime()
                    ->sortable()
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
                SelectFilter::make('role')
                    ->label(__('models.role'))
                    ->options([
                        collect(Roles::cases())
                            ->mapWithKeys(fn(Roles $role) => [$role->value => $role->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),
                SelectFilter::make('country')
                    ->label(__('models.country'))
                    ->options([
                        collect(Countries::cases())
                            ->mapWithKeys(fn(Countries $country) => [$country->value => $country->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),
                SelectFilter::make('country_code')
                    ->label(__('models.country_code'))
                    ->options([
                        collect(CountryCode::cases())
                            ->mapWithKeys(fn(CountryCode $code) => [$code->value => $code->getLabel()])
                            ->filter(fn($label, $key) => !is_numeric($key))
                            ->toArray()
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
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

