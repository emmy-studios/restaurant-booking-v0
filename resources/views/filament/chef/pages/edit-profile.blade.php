<x-filament-panels::page>

    <x-filament::fieldset>

        <x-slot name="label">
            Personal Information
        </x-slot>
        
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <x-filament::input.wrapper 
                suffix-icon="heroicon-o-user"
                suffix-icon-color="success"
                style="padding-bottom: 4px;">
 
                <x-filament::input 
                    type="text" 
                    model="name" 
                    placeholder="Name"
                    value="{{ $chef->name }}">
                </x-filament::input>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper 
                suffix-icon="heroicon-o-user"
                suffix-icon-color="success">

                <x-filament::input 
                    type="text" 
                    model="firstName" 
                    placeholder="First Name"
                    value="{{ $chef->first_name }}">
                </x-filament::input>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper 
                suffix-icon="heroicon-o-user"
                suffix-icon-color="success">

                <x-filament::input 
                    type="text" 
                    model="firstName" 
                    placeholder="Last Name"
                    value="{{ $chef->last_name }}">
                </x-filament::input>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper 
                suffix-icon="heroicon-o-user"
                suffix-icon-color="success">

                <x-filament::input 
                    type="text" 
                    model="firstName" 
                    placeholder="Phone Code"
                    value="{{ $chef->phone_code }}">
                </x-filament::input>
            </x-filament::input.wrapper>

            <x-filament::input.wrapper 
                suffix-icon="heroicon-o-user"
                suffix-icon-color="success">

                <x-filament::input 
                    type="text" 
                    model="firstName" 
                    placeholder="Phone Number"
                    value="{{ $chef->phone_number }}">
                </x-filament::input>
            </x-filament::input.wrapper>

        </div>

    </x-filament::fieldset>

    <x-filament::fieldset>

        <x-slot name="label">
            Address Information
        </x-slot>

    </x-filament::fieldset>

    <x-filament::button
        icon="heroicon-o-sparkles"
        icon-position="before"
        style="width: 8rem;">
        Save
    </x-filament::button>

</x-filament-panels::page>
