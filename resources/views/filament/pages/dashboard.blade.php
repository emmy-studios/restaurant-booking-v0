<x-filament-panels::page>

    {{-- Date Section --}}
    <div
        style="display:
               flex; justify-content:
               flex-end; margin-top: 10px;
               margin-bottom: 10px;">
        <p style="font-weight: bold; color: #E77917;">
            {{ $currentDate }}
        </p>
    </div> 

    {{-- Hero Card --}}
    <div
        style="display: grid;
               grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
               gap: 10px;
               background-color: #fff;
               border-radius: 20px;
               padding: 20px 20px;">

        <div
            style="display: flex;
                   flex-direction: column;
                   justify-content: center;
                   align-items: flex-start;
                   gap: 10px">

            <span style="font-weight: bold; font-size: 1.5rem; color: #E77917;">
                Welcome Back, {{ $adminInfo->name }}!
            </span>
            <p style="color: cornflowerblue;">
                This is the admin panel.
            </p>
            <p style="color:cornflowerblue;">
                You can control all the information, models and fields 
                of the web application.
            </p>

        </div>

        <div style="display: flex; justify-content: flex-end;">
            <img
                style="height: 20rem;"
                src="{{ asset('assets/images/panels/background01.png') }}"
            />
        </div>

    </div>

    {{-- Filament Widget Section --}}
    <div
        style="
            display: flex;
            flex-direction: column;
            margin-top: 10px;
            margin-bottom: 10px;">

        @foreach($this->getWidgets() as $widget)
            <div style="margin-top: 15px; margin-bottom: 15px;">
                @livewire($widget)
            </div>
        @endforeach
    </div>

</x-filament-panels::page>
 