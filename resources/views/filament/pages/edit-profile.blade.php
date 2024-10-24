<x-filament-panels::page>

  <form wire:submit.prevent="submit">

    {{ $this->form }}

    <div style="padding-top: 10px">

        <x-filament::button
            icon="heroicon-o-rocket-launch"
            icon-position="before"
            type="submit" 
            color="warning">

            {{ __('Save') }}
        
        </x-filament::button>

    </div>

  </form>

</x-filament-panels::page>