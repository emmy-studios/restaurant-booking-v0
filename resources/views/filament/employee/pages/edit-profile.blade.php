<x-filament-panels::page>

    <x-filament::section>

        <x-slot name="heading">
            Change your personal information here
        </x-slot>

        <x-filament::fieldset>
            <x-slot name="label">
                Personal Data
            </x-slot>
             
            <p>Name: </p>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="name"
                />
            </x-filament::input.wrapper>

            <p>First Name: </p>
            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    wire:model="name"
                />
            </x-filament::input.wrapper>
            

        </x-filament::fieldset>
    
    </x-filament::section>

</x-filament-panels::page>
