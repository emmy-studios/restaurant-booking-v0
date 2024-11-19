<x-filament-panels::page>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/filament/filament/employee/employee_notice.css') }}">
    @endpush

    @foreach($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

</x-filament-panels::page>
