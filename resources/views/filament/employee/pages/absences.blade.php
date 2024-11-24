<x-filament-panels::page>

    <div class="emp_absences-chart">
        <div>
            @livewire($this->getEmployeeJustifiedAbsencesChartWidget())
        </div>
        <div>
            @livewire($this->getEmployeeAbsencesPieChartWidget())
        </div>
    </div>

    @foreach($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

    <style>
        .emp_absences-chart {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media(max-width: 768px) {
            .emp_absences-chart {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

</x-filament-panels::page>
