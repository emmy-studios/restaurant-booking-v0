<x-filament-panels::page>

    {{-- Date Section --}}
    <div
        style="display:
               flex; justify-content:
               flex-end; margin-top: 10px;
               margin-bottom: 10px;">
        <p>12 May 2024, Friday</p>
    </div>

    {{-- Hero Card --}}
    <div
        style="display: grid;
               grid-template-columns: 2fr 1fr;
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

            <h1 style="font-weight: bold; font-size: 1.5rem">
                Welcome Back, {{ $chef->first_name }} {{ $chef->last_name }}!
            </h1>
            <p style="color: gray;">
                You have a chef role and permissions.
            </p>
            <p style="color: gray;">
                To see your new tasks and notices, go to the
                notices page.
            </p>
            <x-filament::button
                src="{{ route('filament.chef.pages.notices') }}"
                tag="a"
                icon="heroicon-o-bell-alert"
                color="danger"
                size="xl"
                badge-color="danger">
                <x-slot name="badge">
                    {{ $notices->count() }}
                </x-slot>
                Notices

            </x-filament::button>

        </div>

        <div style="display: flex; justify-content: center;">
            <img
                style="height: 20rem;"
                src="{{ asset('assets/images/panels/background01.png') }}"
            />
        </div>

    </div>

    {{-- StatsOverview Section --}}
    <div
        style="
            display: flex;
            flex-direction: column;
            margin-top: 10px;
            margin-bottom: 10px;">

        <p style="font-weight: bold; padding: 10px 10px;">Stats Overview</p>

        @foreach($this->getWidgets() as $widget)
            <div style="margin-top: 15px; margin-bottom: 15px;">
                @livewire($widget)
            </div>
        @endforeach
    </div>

</x-filament-panels::page>
