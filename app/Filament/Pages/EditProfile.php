<?php

namespace App\Filament\Pages;

use App\Enums\Countries;
use App\Enums\CountryCode;
use App\Enums\Gender;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $view = 'filament.pages.edit-profile';

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
    public $identification_code;
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

    public function mount()
    {
        $admin = Auth::user();

        // Fill the Form with Admin Data
        $this->form->fill([
            'name' => $admin->name,
            'identification_code' => $admin->identification_code,
            'first_name' => $admin->first_name,
            'last_name' => $admin->last_name,
            'email' => $admin->email,
            'country_code' => $admin->country_code,
            'phone_number' => $admin->phone_number,
            'country' => $admin->country,
            'gender' => $admin->gender,
            'city' => $admin->city,
            'address' => $admin->address,
            'postal_code' => $admin->postal_code,
        ]);
    }

    public function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make(__('panels.personal_information'))
                    ->columns(2)
                    ->icon('heroicon-o-identification')
                    //->description(__('panels.change_your_personal_information'))
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('models.name'))
                            ->required(),
                        TextInput::make('identification_code')
                            ->label(__('models.identification_code')),
                        TextInput::make('first_name')
                            ->label(__('models.first_name')),
                        TextInput::make('last_name')
                            ->label(__('models.last_name')),
                        Select::make('gender')
                            ->options(Gender::class)
                            ->searchable()
                            ->label(__('models.gender')),
                    ]),
                Wizard\Step::make(__('panels.contact_information'))
                    ->icon('heroicon-o-signal')
                    //->description(__('panels.change_your_contact_information'))
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
                    //->description('Change your address information')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->columns(2)
                    ->schema([
                        Select::make('country')
                            ->options(Countries::class)
                            ->label(__('models.country')),
                        TextInput::make('city')
                            ->label(__('models.city')),
                        MarkdownEditor::make('address')
                            ->columnSpanFull()
                            ->label(__('models.address')),
                    ]),
            ])
        ];
    }

    public function submit()
    {
        // Validate Data
        $validatedData = $this->form->getState();

        // Get Authenticated User
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        // Update Data
        $admin->update($validatedData);

        return redirect()->route('filament.admin.pages.profile');
    }

}

