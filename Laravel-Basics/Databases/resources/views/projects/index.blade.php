@extends('layouts/master')

@section('title','Projekty')

@section('content')
    <div class="container">
        <h1>Elo Melo</h1>
        <ol>
        @foreach ($projects as $project)
            <li><a class="text-decoration-none" href="/projects/{{$project->id}}">{{ $project->title }}</a></li>
        @endforeach
        </ol>
    </div>
@endsection