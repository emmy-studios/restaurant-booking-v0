<x-filament-panels::page>

    <div class="emp_header-row">
        <div></div>
        <div></div>
    </div>

    @foreach ($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

    <style>
        .emp_header-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media(max-width: 768px) {
            .emp_header-row {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

</x-filament-panels::page>
