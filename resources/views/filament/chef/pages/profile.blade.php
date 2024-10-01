<x-filament-panels::page>

    <p>{{ __('Real-Time Information and Activities of your Property') }}</p>

    <x-filament::section>

        <x-slot name="heading"> 
            
            <div 
                style="display: flex; align-items: center;">

                @if($chef->image_url)
                    <x-filament::avatar 
                        src="{{ asset('storage/' . $chef->image_url) }}"
                        alt="{{ $chef->name }}"
                        size="w-16 h-16"
                    /> 
                @else
                    <x-filament::avatar
                        src="{{ asset('assets/images/panels/chef_profile.png') }}"
                        alt="Default Profile Image"
                        size="h-16 w-16"
                    />
                @endif

                <p style="padding-left: 10px;">
                    {{ $chef->name }}
                </p>

            </div>

            <p style="padding-top: 8px;">{{ $chef->first_name }} {{ $chef->last_name }}</p>

        </x-slot>

        <x-slot name="headerEnd">
            <x-filament::modal>
                <x-slot name="heading">
                    {{ __('Upload Photo') }}
                </x-slot>

                <x-slot name="trigger">
                    <x-filament::button>
                        {{ __('Change Photo') }}
                    </x-filament::button>
                </x-slot>

                <x-slot name="description">
                    {{ __('Choose a jpg/png/jpeg file') }}
                </x-slot>

                <x-filament::input.wrapper>
                    <x-filament::input
                        type="file"
                        wire:model="newImage"
                    />
                </x-filament::input.wrapper>

                <x-filament::button wire:click="saveImage">
                    {{ __('Save') }}
                </x-filament::button>
            </x-filament::modal>
        </x-slot>

        <p>
            {{ __('models.phone_number') }}: {{ $chef->phone_code }} {{ $chef->phone_number }}
        </p>
        <p>{{ __('models.role') }}: {{ $chef->role }}</p>

    </x-filament::section>

    <x-filament::section icon="heroicon-o-envelope" icon-color="success" icon-size="lg">

        <x-slot name="heading">
            <p>{{ __('Contact Email') }}</p>
            <h2>{{ __('The Email Address for Receive Notifications') }}.</h2>
        </x-slot>

        <p>{{ $chef->email }}</p>

    </x-filament::section>

    <x-filament::section icon="heroicon-o-map-pin" icon-color="info" icon-size="lg">

        <x-slot name="heading">
            <p>{{ __('Address Information') }}</p>
            <h2>{{ __('Your Personal Address Information') }}</h2>
        </x-slot>

        <div style="display: flex;">
            <span style="font-weight: 600; padding-right: 4px; padding-bottom: 2px;">
                {{ __('models.country') }}:
            </span>
            <p>
                {{ $chef->country }}
            </p> 
        </div>

        <div style="display: flex;">
            <span style="font-weight: 600; padding-right: 4px; padding-bottom: 2px;">
                {{ __('models.city') }}:
            </span>
            <p>
                {{ $chef->city }}
            </p>
        </div>

        <div style="display: flex;">
            <span style="font-weight: 600; padding-right: 4px; padding-bottom: 2px;">
                {{ __('models.address') }}:
            </span>
            <p>
                {{ $chef->address }}
            </p>
        </div>

        <div style="display: flex;">
            <span style="font-weight: 600; padding-right: 4px; padding-bottom: 2px;">
                {{ __('models.postal_code') }}:
            </span>
            <p>
                {{ $chef->postal_code }}
            </p>
        </div>

    </x-filament::section>

</x-filament-panels::page>
