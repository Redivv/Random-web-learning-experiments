@component('mail::message')
# Nowy Projekt : {{$project->title}}

{{$project->desc}}

@component('mail::button', ['url' => url('/projects/'.$project->id)])
Zobacz Projekt
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
