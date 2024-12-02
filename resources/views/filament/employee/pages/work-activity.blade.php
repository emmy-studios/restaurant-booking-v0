<x-filament-panels::page>

    <div class="emp_header-row">

        <div class="emp_chart-container">
            @livewire($this->getWorkedHoursChart())
        </div>

        <div class="emp_card-container">

            <div class="emp_card-one">
                <div class="emp_card-image">
                    <img src="{{ asset('assets/images/panels/calendar.svg') }}">
                </div>
                <div class="emp_card-container-info">
                    <p class="emp_title-card">
                        {{ __('panels.stats.current_salary') }}
                    </p>
                    <span class="emp_subtitle-card">
                        {{ $schedule->shift_start_time }} - {{ $schedule->shift_end_time }}
                    </span>
                </div>
            </div>

            <div class="emp_card-two">
                <div class="emp_card-image">
                    <img src="{{ asset('assets/images/panels/salary_icon.svg') }}">
                </div>
                <div class="emp_card-container-info">
                    <p class="emp_title-card">
                        {{ __('panels.stats.current_salary') }}
                    </p>
                    <span class="emp_subtitle-card">
                        {{ $salary->currency_symbol }} {{ $salary->base_salary }}
                    </span>
                </div>
            </div>

        </div>

    </div>

    <div>
        @foreach ($this->getStats() as $stat)
            @livewire($stat)
        @endforeach
    </div>

    @foreach ($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

    <style>
        .emp_header-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .emp_card-container {
            display: flex;
            padding-left: 20px;
            flex-direction: column;
        }
        .emp_card-one {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            height: 50%;
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 0.5px solid #FF7F3E;
            padding: 10px 10px;
        }
        .emp_card-image {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30%;
        }
        .emp_card-image img {
            width: 80px;
            height: 80px;
        }
        .emp_card-container-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 10px 10px;
            width: 100%;
        }
        .emp_title-card {
            font-weight: bold;
            font-size: 1rem;
            color: #000;
        }
        .emp_subtitle-card {
            color: gray;
        }
        .emp_card-two {
            display: flex;
            align-items: center;
            height: 50%;
            background-color: #fff;
            border-radius: 10px;
            border: 1px solid #AB886D;
        }

        @media(max-width: 1114px) {
            .emp_header-row {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }
            .emp_card-container {
                padding-left: 0px;
            }
            .emp_card-one {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 20vh;
                margin-top: 10px;
            }
            .emp_card-two {
                height: 20vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .emp_card-container-info {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 10px;
            }
        }
        @media(max-width: 768px) {
            .emp_card-one {
                height: 30vh;
            }
        }

    </style>

</x-filament-panels::page>
