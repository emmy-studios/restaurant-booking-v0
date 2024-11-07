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
        style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            align-items: center;
            margin-bottom: 20px;">

        {{-- Welcome Message Section --}}
        <div
            style="display: flex;
                   flex-direction: column;
                   gap: 15px;">
            <h1 style="font-size: 2rem; font-weight: bold; color: #333;">
                {{ __('Welcome Back') }}, {{ $employee->name }}!
            </h1>
            <p style="color: gray;">
                You have a {{ $employee->role }} role and permissions.
            </p>
            <p style="color: gray;">
                To see your new tasks and notices, go to the
                notices page.
            </p>
            <div>
                <x-filament::button
                    src="{{ route('filament.employee.pages.dashboard') }}"
                    tag="a"
                    icon="heroicon-o-bell-alert"
                    color="danger"
                    size="sm"
                    badge-color="danger">
                    <x-slot name="badge">
                        {{ $notices->count() }}
                    </x-slot>
                    Notices

                </x-filament::button>
            </div>
        </div>

        {{-- Image Section --}}
        <div style="display: flex; justify-content: center; align-items: center;">
            <img
                src="{{ asset('assets/images/panels/background01.png') }}"
                alt="Dashboard Illustration"
                style="max-width: 100%; height: auto; border-radius: 15px;">
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

    <style>
        @media (max-width: 768px) {
            div[style*="grid-template-columns: 1fr 1fr"] {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.95rem;
            }

            a {
                width: 100%;
                text-align: center;
            }
        }
    </style>


</x-filament-panels::page>

