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
                src="{{ asset('storage/' . $adminData->image_url) }}" 
                alt="Profile Image"
                style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        {{-- Profile Info --}}
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <h2 style="font-size: 1.25rem; font-weight: bold; color: #333;">
                {{ $adminData->first_name }} {{ $adminData->last_name }}
            </h2>
            <p style="font-size: 1rem; color: #555;">{{ $adminData->name }}</p>
            <p style="font-size: 1rem; color: #555;">{{ $adminData->email }}</p>
            <p style="font-size: 1rem; color: #555;">
                {{ $adminData->country_code }} {{ $adminData->phone_number }}
            </p>
        </div>

        {{-- External Link Icon --}}
        <div style="display: flex; align-items: center; justify-content: flex-end;">
            <a href="{{ route('filament.admin.pages.edit-profile') }}" 
                style="color: #E77917; text-decoration: none;">
                <x-heroicon-o-pencil-square class="w-6 h-6"/>
            </a>
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

            {{-- Identification and Role --}}
            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.identification_code') }}</p>
                <p style="color: #555;">{{ $adminData->identification_code }}</p>
            </div>

            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.role') }}:</p>
                <p style="color: #555;">{{ $adminData->role }}</p>
            </div>

            {{-- Address --}}
            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.address') }}:</p>
                <p style="color: #555;">{{ $adminData->address }}, {{ $adminData->city }}</p>
            </div>

            {{-- Country and Postal Code --}}
            <div>
                <p style="font-weight: bold; color: #333;">{{ __('models.country') }}:</p>
                <p style="color: #555;">{{ $adminData->country }}</p>
                <p style="font-weight: bold; color: #333;">{{ __('models.city') }}:</p>
                <p style="color: #555;">{{ $adminData->city }}</p>
            </div>
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
