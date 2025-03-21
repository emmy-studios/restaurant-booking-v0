<?php

namespace App\Filament\Employee\Pages;

use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\Gender;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Tabs;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $view = 'filament.employee.pages.edit-profile';

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function getNavigationLabel(): string
    {
        return __('Edit Profile');
    }

    public function getHeading(): string
    {
        return __('Edit Profile');
    }

    // Get Personal Information
    public $name;
    public $identification_number;
    public $first_name;
    public $last_name;
    public $email;
    public $country_code;
    public $phone_number;
    public $country;
    public $gender;
    public $city;
    public $address;
    public $postal_code;
    public $birth;

    public function mount()
    {
        $employee = Auth::user();

        // Fill the Form with Admin Data
        $this->form->fill([
            'name' => $employee->name,
            'identification_number' => $employee->identification_number,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'birth' => $employee->birth,
            'country_code' => $employee->country_code,
            'phone_number' => $employee->phone_number,
            'country' => $employee->country,
            'gender' => $employee->gender,
            'city' => $employee->city,
            'address' => $employee->address,
            'postal_code' => $employee->postal_code,
        ]);
    }
    /*
    public function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make(__('panels.personal_information'))
                    ->columns(2)
                    ->icon('heroicon-o-identification')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('models.name'))
                            ->required(),
                        TextInput::make('identification_number')
                            ->label(__('models.identification_number')),
                        TextInput::make('first_name')
                            ->label(__('models.first_name')),
                        TextInput::make('last_name')
                            ->label(__('models.last_name')),
                        Select::make('gender')
                            ->options(Gender::class)
                            ->searchable()
                            ->label(__('models.gender')),
                        DatePicker::make('birth')
                            ->label(__('models.date_of_birth')),
                    ]),
                Wizard\Step::make(__('panels.contact_information'))
                    ->icon('heroicon-o-signal')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label(__('models.email'))
                            ->required(),
                        TextInput::make('postal_code')
                            ->label(__('models.postal_code')),
                        Select::make('country_code')
                            ->options(CountryCode::class)
                            ->searchable()
                            ->label(__('models.phone_code')),
                        TextInput::make('phone_number')
                            ->label(__('models.phone_number'))
                    ]),
                Wizard\Step::make(__('panels.address_information'))
                    ->icon('heroicon-o-map-pin')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->columns(2)
                    ->schema([
                        Select::make('country')
                            ->options(Countries::class)
                            ->searchable()
                            ->label(__('models.country')),
                        TextInput::make('city')
                            ->label(__('models.city')),
                        MarkdownEditor::make('address')
                            ->columnSpanFull()
                            ->label(__('models.address')),
                    ]),
            ])
        ];
    }*/

    public function getFormSchema(): array
    {
        return [
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Tab 1')
                        ->label(__('panels.personal_information'))
                        ->icon('heroicon-o-identification')
                        ->schema([
                            TextInput::make('name')
                                ->label(__('models.name'))
                                ->required(),
                            TextInput::make('identification_number')
                                ->label(__('models.identification_number')),
                            TextInput::make('first_name')
                                ->label(__('models.first_name')),
                            TextInput::make('last_name')
                                ->label(__('models.last_name')),
                            Select::make('gender')
                                ->options(Gender::class)
                                ->searchable()
                                ->label(__('models.gender')),
                            DatePicker::make('birth')
                                ->label(__('models.date_of_birth')),
                        ])->columns(2),
                    Tabs\Tab::make('Tab 2')
                        ->label(__('panels.contact_information'))
                        ->icon('heroicon-o-signal')
                        ->schema([
                            TextInput::make('email')
                                ->label(__('models.email'))
                                ->required(),
                            TextInput::make('postal_code')
                                ->label(__('models.postal_code')),
                            Select::make('country_code')
                                ->options(CountryCode::class)
                                ->searchable()
                                ->label(__('models.phone_code')),
                            TextInput::make('phone_number')
                                ->label(__('models.phone_number')),
                        ])->columns(2),
                    Tabs\Tab::make('Tab 3')
                        ->label(__('panels.address_information'))
                        ->icon('heroicon-o-map-pin')
                        ->schema([
                            Select::make('country')
                                ->options(Countries::class)
                                ->searchable()
                                ->label(__('models.country')),
                            TextInput::make('city')
                                ->label(__('models.city')),
                            MarkdownEditor::make('address')
                                ->columnSpanFull()
                                ->label(__('models.address')),
                        ])->columns(2),
                ])
                ->activeTab(1)
                ->contained(true)
        ];
    }

    public function submit()
    {
        // Validate Data
        $validatedData = $this->form->getState();

        // Get Authenticated User
        /** @var \App\Models\User $employee */
        $employee = Auth::user();

        // Update Data
        $employee->update($validatedData);

        return redirect()->route('filament.employee.pages.profile');
    }

}


