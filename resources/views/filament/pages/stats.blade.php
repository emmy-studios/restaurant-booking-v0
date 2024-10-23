<x-filament-panels::page>
  
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
