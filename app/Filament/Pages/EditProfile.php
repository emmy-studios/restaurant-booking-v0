<?php

namespace App\Filament\Pages;

use App\Enums\Countries;
use App\Enums\CountryCode;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
    public $firstName;
    public $lastName;
    public $email;
    public $phoneCode;
    public $phoneNumber;
    public $country;
    public $city; 
    public $address;
    public $postalCode;

    public function mount()
    {
        $admin = Auth::user();
 
        // Fill the Form with Admin Data
        $this->form->fill([
            'name' => $admin->name,
            'firstName' => $admin->first_name,
            'lastName' => $admin->last_name,
            'email' => $admin->email,
            'phoneCode' => $admin->country_code,
            'phoneNumber' => $admin->phone_number,
            'country' => $admin->country,
            'city' => $admin->city,
            'address' => $admin->address,
            'postalCode' => $admin->postal_code,
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
                        TextInput::make('firstName')
                            ->label(__('models.first_name')),
                        TextInput::make('lastName')
                            ->columnSpanFull()
                            ->label(__('models.last_name'))
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
                        Select::make('phoneCode')
                            ->options(CountryCode::class)
                            ->label(__('models.phone_code')),
                        TextInput::make('phoneNumber')
                            ->columnSpanFull()
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
 