<x-filament-panels::page>

    <div
        style="
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            background-color: #f9f9f9;
            border-radius: 20px;
            max-width: 600px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

        {{-- Profile Image --}}
        <div
            style="
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background-color: white;
                overflow: hidden;">

                <img
                    src="{{ $chef->image_url ? asset('storage/' . $chef->image_url) : asset('assets/images/panels/admin_profile.png') }}"
                    alt="Profile Image"
                    style="width: 100%; height: 100%; object-fit: cover;">

        </div>

        {{-- Profile Info --}}
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <h2 style="font-size: 1.25rem; font-weight: bold; color: #333;">
                {{ $chef->first_name }} {{ $chef->last_name }}
            </h2>
            <p style="font-size: 1rem; color: #555;">{{ $chef->name }}</p>
            <p style="font-size: 1rem; color: #555;">{{ $chef->email }}</p>
            <p style="font-size: 1rem; color: #555;">
                {{ $chef->country_code }} {{ $chef->phone_number }}
            </p>
        </div>

        {{-- Update Profile Image Modal --}}
        <div
            style="display: flex; align-items: center; justify-content: flex-end;"
        >

            <x-filament::modal
                icon="heroicon-o-photo"
                icon-color="success"
                alignment="start"
                sticky-header
                sticky-footer
            >

                <x-slot name="trigger">
                    <x-heroicon-o-pencil-square
                        class="w-5 h-5"
                        style="color: #E77917;"
                    />
                </x-slot>

                <x-slot name="heading">
                    {{ __('panels.change_profile_image') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('panels.upload_a_jpg,_png,_jpeg_file') }}.
                </x-slot>

                {{-- Modal content --}}
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="file"
                        wire:model="newImage"
                    />
                </x-filament::input.wrapper>

                <x-slot name="footerActions">
                    <x-filament::button wire:click="saveImage">
                        {{ __('panels.save') }}
                    </x-filament::button>
                </x-slot>

            </x-filament::modal>

        </div>

    </div>

    {{-- Profile Information --}}
    <div
        style="
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

        <h3 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
            {{ __('panels.personal_information') }}
        </h3>

        <div
            style="
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;">

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.identification_number') }}:</p>
                <p style="color: #555;">{{ $chef->identification_number }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.role') }}:</p>
                <p style="color: #555;">{{ $chef->role }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.first_name') }}:</p>
                <p style="color: #555;">{{ $chef->first_name }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.last_name') }}:</p>
                <p style="color: #555;">{{ $chef->last_name }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.postal_code') }}:</p>
                <p style="color: #555;">{{ $chef->postal_code }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.gender') }}:</p>
                <p style="color: #555;">{{ $chef->gender }}</p>
            </div>
        </div>

    </div>

    {{-- Address Information --}}
    <div
        style="
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            max-width: 1000px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">

        <h3 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 20px;">
            {{ __('panels.address_information') }}
        </h3>

        <div
            style="
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;">

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.country') }}:</p>
                <p style="color: #555;">{{ $chef->country }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.city') }}:</p>
                <p style="color: #555;">{{ $chef->city }}</p>
            </div>

        </div>

        <div style="padding-top: 20px;">
            <p style="font-weight: bold; color: #333;">{{ __('models.address') }}:</p>
            <p style="color: #555;">{{ $chef->address }}</p>
        </div>

    </div>

    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            h2, h3 {
                font-size: 1.25rem;
            }
        }
    </style>

</x-filament-panels::page>

