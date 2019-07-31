@extends('layouts/master')

@section('title', 'Edytuj Projekt')

@section('content')
    <div class="container">
        <h1 class="title">Edytuj Post</h1>
        <form method="post" action="/projects/{{$project->id}}">
            {{ method_field('patch') }}         <!-- jako że restowego requesta PATCH nie obsługują przeglądarki więc używając blade-owego helpera dodajemy ukryty input mówiący jaki naprawdę jest używany request -->
            {{ csrf_field() }}
            <div class="form-group">
                <label for="">Tytuł</label>
                <input type="text" name="title" class="form-control {{$errors->has('title') ? 'border-danger' : ''}}" value="{{$project->title}}">
            </div>
            <div class="form-group">
                <label for="">Opis</label>
                <textarea type="text" name="desc" class="form-control {{$errors->has('desc') ? 'border-danger' : ''}}">{{$project->desc}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Zapisz</button>
        </form>

        <form class="mt-2" method="post" action="/projects/{{$project->id}}">
            {{ method_field('delete') }}        <!-- jako że restowego requesta DELETE nie obsługują przeglądarki więc używając blade-owego helpera dodajemy ukryty input mówiący jaki naprawdę jest używany request -->
            {{ csrf_field() }}                  <!-- helper dodający ukrytego inputa chroniącego przed atakiem csrv (bez niego strona zwróci błąd) -->
            <button class="btn btn-danger" type="submit">Usuń</button>
        </form>

        @if ($errors->any())        <!-- prosty blade-owy if i metoda zwracająca 1 jeśli jest jakikolwiek obiekt $error  -->
            <div class="notifications bg-danger text-white alert">
                <ul class="mb-0 list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>    
        @endif
    </div>
@endsection