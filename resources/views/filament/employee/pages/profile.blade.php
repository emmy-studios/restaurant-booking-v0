<x-filament-panels::page>

    <x-filament::section>

        <x-slot name="heading">
            @if($employee->image_url)

                <x-filament::avatar 
                    src="{{ asset('storage/' . $employee->image_url) }}"
                    alt="{{ $employee->name }}"
                    size="w-16 h-16"
                /> 
            @else
                <x-filament::avatar
                    src="{{ asset('assets/images/panels/employee_profile.png') }}"
                    alt="Default Profile Image"
                    size="h-16 w-16"
                />
            @endif

            <p style="margin-top: 10px">
                {{ $employee->name }}
            </p>
            <h1>
                {{ $employee->first_name }} {{ $employee->last_name }}
            </h1>
            <h2>
                {{ $employee->email }}
            </h2>
        </x-slot>    

        <p>Role: {{ $employee->role }}</p>

    </x-filament::section>

    <x-filament::section>
        
        <x-slot name="heading"> 
            <p>Personal Information</p>
            <h2>User Personal Information</h2>
        </x-slot>

        <p>
            <span style="color: #a517e7">First Name:</span> {{ $employee->first_name }}
        </p>
        <p>
            <span style="color: #a517e7">Last Name:</span> {{ $employee->last_name }}
        </p>
        <p>
            <span style="color: #a517e7">Email:</span> {{ $employee->email }}
        </p>
        <p>
            <span style="color: #a517e7">Phone:</span> {{ $employee->country_code }} {{ $employee->phone_number }}
        </p>
        <p>
            <span style="color: #a517e7">Email:</span> {{ $employee->gender }}
        </p>

    </x-filament::section>

    <x-filament::section> 

        <x-slot name="heading">
            <p>Address Information</p>
            <h2>User Address Information</h2>
        </x-slot>
 
        <p>
            <span style="color: #a517e7">Country:</span> {{ $employee->country }}
        </p>
        <p>
            <span style="color: #a517e7">City:</span> {{ $employee->city }}
        </p>
        <p>
            <span style="color: #a517e7">Adress:</span> {{ $employee->address }}
        </p>
        <p>
            <span style="color: #a517e7">Postal Code:</span> {{ $employee->country }}
        </p>

    </x-filament::section>

</x-filament-panels::page> 
 