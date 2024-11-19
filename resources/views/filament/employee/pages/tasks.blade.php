<x-filament-panels::page>

    @foreach($this->getWidgets() as $widget)
        @livewire($widget)
    @endforeach

    <x-filament::section
        icon="heroicon-o-information-circle"
        icon-color="danger"
        collapsible
        collapsed
    >

        <x-slot name="heading">
            Task Options
        </x-slot>

        <x-slot name="description">
            This is all the information we hold about the user.
        </x-slot>

        {{-- Content --}}
        <p>There are the options for the task status.</p>

    </x-filament::section>

</x-filament-panels::page>
