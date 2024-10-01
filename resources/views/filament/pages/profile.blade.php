<x-filament-panels::page>

    <x-filament::section>

        <x-slot name="heading">
            
            @if( Storage::disk('public')->exists($adminData->image_url) )

                <x-filament::avatar 
                    src="{{ asset('storage/' . $adminData->image_url) }}"
                    alt="{{ $adminData->name }} Profile Image"
                    size="w-16 h-16"
                /> 
            @else
                <x-filament::avatar
                    src="{{ asset('assets/images/panels/admin_profile.png') }}"
                    alt="Default Profile Image"
                    size="lg"
                />
            @endif

            <p style="margin-top: 10px">
                {{ $adminData->name }}
            </p>
            <h1>
                {{ $adminData->first_name }} {{ $adminData->last_name }}
            </h1>
            <h2>
                {{ $adminData->email }}
            </h2>

        </x-slot>

        <p>
            Este es un perfil de administrador.
            Tiene todos los permisos necesarios para controlar la
            aplicación web.
        </p>

    </x-filament::section>  

</x-filament-panels::page>
 