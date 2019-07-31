@extends('layouts/master')

@section('title','Stwórz Nowy Projekt')

@section('content')
    <div class="container-fluid">
        <h1>Projekty Nowe Rób Now</h1>

        <form method="post" action="/projects">
            {{ csrf_field() }}      <!-- Wypisuje ukryty input z unikalnym kluczem który w jakiś sposób zwiększa bezpieczeństwo (gut shit)  -->
            <div class="form-group">
                <input class="form-control {{$errors->has('title') ? 'border-danger' : ''}} " name="title" type="text" placeholder="Tytuł Projektu" value="{{old('title')}}" required>
            </div>
            <div class="form-group">
                <textarea class="form-control {{$errors->has('desc') ? 'border-danger' : ''}}" name="desc" placeholder="Opis Projektu" required>{{old('desc')}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Zapisz</button>
            </div>
        </form>

        @include('partials/errors')         {{-- Identycznie co php-owe include --}}
        
    </div>
@endsection