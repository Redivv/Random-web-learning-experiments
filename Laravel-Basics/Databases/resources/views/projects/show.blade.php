@extends('layouts/master')

@section('title')
    Projekt numer {{$project->id}}
@endsection

@section('content')
    <div class="container">
        <h1 class="title mt-2">{{$project->title}}</h1>
        <hr>
        <p>{{$project->desc}}</p>
        <a href="{{$project->id}}/edit"><button class="btn btn-link">Edytuj</button></a>
        <hr>
        @if ($project->tasks->count()) 
            <div class="container">
                <h3>Zadania</h3>
                <ul class="list-unstyled">
                    @foreach ($project->tasks as $task)
                    <div class="pl-3">
                        <li>
                            <form method="post" action="/tests/{{$project->id}}/tasks/{{$task->id}}">
                                @method('patch')
                                {{ csrf_field() }}
                                <div class="form-check">
                                  <label class="form-check-label {{$task->completed ? 'is-done' : ''}}">
                                    <input type="checkbox" class="form-check-input" name="completed" value="yes" onChange="this.form.submit()" {{$task->completed ? 'checked' : ''}} >
                                    {{$task->desc}}
                                    
                                  </label>
                                </div>
                            </form>
                        </li>
                    </div>
                    @endforeach
                </ul>
            </div>  
        @endif

        {{-- Add New Task Form --}}

        <form class="mb-4" method="post" action="/tests/{{$project->id}}/tasks">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="">Nowe Zadanie</label>
              <input type="text" name="task" class="form-control {{$errors->has('task') ? 'border-danger' : ''}}" value="{{old('task')}}" placeholder="Nazwa" required>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj Zadanie</button>
        </form>

        @include('partials/errors')     {{-- Identycznie co php-owe include --}}
        
    </div>
@endsection