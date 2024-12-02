<x-filament-panels::page>

    {{-- Date Section --}}
    <div class="emp_date-section">
        <p>
            {{ $currentDate }}
        </p>
    </div>

    {{-- Hero Card --}}
    <div class="emp_hero-container">
        {{-- Welcome Message Section --}}
        <div class="emp_hero-message">
            <h1>
                {{ __('Welcome Back') }}, {{ $employee->name }}!
            </h1>
            <p>
                You have a {{ $employee->role }} role and permissions.
            </p>
            <p>
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
        <div class="emp_hero-image">
            <img
                src="{{ asset('assets/images/panels/admin04_profile.png') }}"
                alt="Dashboard Illustration">
        </div>
    </div>

    {{-- Filament Widget Section --}}
    {{--<div
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
    </div>--}}

    <style>

        .emp_date-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            margin-bottom: 100px;
        }
        .emp_date-section p {
            font-weight: bold;
            color: #E77917;
        }
        .emp_hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            /*background-color: #fff;*/
            background-color: #cdb4db;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            /*align-items: center;*/
            margin-bottom: 20px;
            height: 50vh;
        }
        .emp_hero-message {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .emp_hero-message h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }
        .emp_hero-message p {
            color: #a2d2ff;
        }
        .emp_hero-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .emp_hero-image img {
            position: relative;
            top: -200px;
            max-width: 100%;
            height: auto;
            /*height: 500px;*/
            border-radius: 15px;
        }

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

