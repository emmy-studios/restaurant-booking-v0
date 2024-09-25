@extends('layouts.app')

@section('title', 'Krusty | Home Page')

@section('content')
    
    <x-partials.navbar/>

    <main>

        <div class="flex flex-row justify-center my-10">
            <p>Hello World</p>
        </div>

        <div class="flex flex-row justify-center">

            @auth
                <p>This user is authenticated</p>   
            @endauth

            @guest
                <p>This user is not authenticated</p>
            @endguest

        </div>

    </main>

@endsection