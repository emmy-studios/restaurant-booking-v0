@extends('layouts.app')

@section('title', 'Welcome | Restaurant Booking System')

@section('content')
    
    <main>
        <div class="flex flex-row justify-center items-center">
            <h1 class="text-red-500 font-bold">{{ __('Home Page') }}</h1>
        </div>

        <div class="flex flex-row my-10">
            <x-dropdown text="Menu" position="bottom-end">
                <x-dropdown.items text="{{ __('Home Page') }}" />
                <x-dropdown.items text="Dashboard" separator />
            </x-dropdown>
        </div>

    </main>

@endsection