@extends('layouts/layout')      {{-- Zaznacza którego layoutu używamy --}}

@section('title','Home')        {{-- Dane do wydzielonej sekcji można też przekazać liniowo  --}}


@section('content')           {{-- Klamerki oznaczonej wcześniej sekcji do której chcemy umieścić materiały --}}
    <h1>Home {!! $nugga !!}</h1>        {{-- Podobna do poniższej ale !! nie escape-ują danych --}}
    <ul>

    <?php foreach ($tasks as $task) :?>     {{-- Skrócona wersja foreach-a (dla tablic 1 wymiarowych) --}}

        <li><?= $task; ?></li>          {{-- ?= jest interpretowane jako echo --}}

    <?php endforeach; ?>            {{-- Odpowiednik klamry --}}
    
    </ul>

    <ul>

        @foreach ($tasks as $task)          {{-- Identyczna konstrukcja ale z użyciem blade-a --}}
            <li>{{ $task }}</li>            {{-- Identyczna konstrukcja do echo ale z użyciem blade-a jednocześnie wpisany string jest escape-owany --}}
        @endforeach

    </ul>
@endsection