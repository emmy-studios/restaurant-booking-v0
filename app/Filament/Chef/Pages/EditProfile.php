<?php

namespace App\Filament\Chef\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static string $view = 'filament.chef.pages.edit-profile'; 

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
        $chef = Auth::user();

        $this->form->fill([
            'name' => $chef->name,
            'firstName' => $chef->first_name,
            'lastName' => $chef->last_name,
            'email' => $chef->email,
            'phoneCode' => $chef->phone_code,
            'phoneNumber' => $chef->phone_number,
            'country' => $chef->country,
            'city' => $chef->city,
            'address' => $chef->address,
            'postalCode' => $chef->postal_code,
        ]);
        
    }

    public function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make(__('Personal Information'))
                    ->columns(2)
                    ->icon('heroicon-o-identification')
                    ->description('Change your personal information')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('models.name'))
                            ->required(),
                        TextInput::make('firstName')
                            ->label(__('models.first_name')),
                        TextInput::make('lastName')
                            ->label(__('models.last_name'))
                    ]),
                Wizard\Step::make(__('Contact Information'))
                    ->icon('heroicon-o-signal')
                    ->description('Change your contact information')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label(__('models.email'))
                            ->required(),
                        TextInput::make('phoneCode')
                            ->label(__('models.phone_code')),
                        TextInput::make('phoneNumber')
                            ->label(__('models.phone_number'))
                    ]),
                Wizard\Step::make(__('Address Information'))
                    ->icon('heroicon-o-map-pin')
                    ->description('Change your address information')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                    ->columns(2)
                    ->schema([
                        TextInput::make('country')
                            ->label(__('models.country')),
                        TextInput::make('city')
                            ->label(__('models.city')),
                        TextInput::make('address')
                            ->label(__('models.address')),
                        TextInput::make('postalCode')
                            ->label(__('models.postal_code'))
                    ]),
            ])
        ];
    }

    public function submit()
    {
        // Validate Data  
        $validatedData = $this->form->getState();
        // Get Authenticated User
        /** @var \App\Models\User $chef */
        $chef = Auth::user();
        // Update Data
        $chef->update($validatedData);

        return redirect()->route('filament.chef.pages.profile');
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getNavigationLabel(): string
    {
        return __('Edit Profile');     
    }

    public function getHeading(): string
    {
        return __('Edit Profile');
    }
}
