<x-filament-panels::page>
 
    @foreach($this->getWidgets() as $widget)
        <div style="margin-top: 15px; margin-bottom: 15px;">
            @livewire($widget)
        </div>
    @endforeach

</x-filament-panels::page>
