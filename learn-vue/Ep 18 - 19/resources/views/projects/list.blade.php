@if (count($projects) > 0 )
    <h1 class="title is-3">Moje Projekty</h1>
    <ul>
        @foreach ($projects as $project)
            <li class="has-text-primary"> {{$project->name}} </li>
        @endforeach
    </ul>
    <hr>
@endif