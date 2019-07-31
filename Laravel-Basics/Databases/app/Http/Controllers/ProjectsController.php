<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Test;
use App\Services\Twitter;
use App\Mail\ProjectCreated;
use App\Events\NewProject;

class ProjectsController extends Controller
{

    public function __construct() {

        $this->middleware('auth');            // wprowadzamy walidację - każdy endpoint poza index i show musi ją przejść 
    }

    public function index()
    {
        
        $projects = auth()->user()->tests;            // enkapsulacja for the win
    
        // $projects = Test::where('owner_id',auth()->id())->get();       // używając namespaca pobieramy z modelu Test wybrane rekordy

        //return $projects;       // wypisując returna można przedwcześnie zakończyć skrypt zwracając jsona do przeglądarki i ona go wyświetli

        // dump($projects);   // dumpuje informacje o danych do Telescope-a

        // cache()->rememberForever('stats', function(){        // cache zapamiętuje na zawsze (Set) klucz stats pod który ma tablice taką jak w funkcji
        //     return [
        //         'lessons' => 1300, 
        //         'hours'   => 50000,
        //         'series'  => 100
        //     ];
        // });

        // $stats = cache()->get('stats');     // wyciąganie wartości z cache tak jak przy normalnej bazie ->get

        // dump($stats);

        return view('projects/index',compact('projects')); // identycznie przesyła zmienną tak jak inne metody, sama funkcja zwraca tablicę nazwa zmiennej => wartość, jako parametry przyjmuje nazwy zmiennych
    }

    public function create()
    {
        return view('projects/create');
    }

    public function show(Test $project, Twitter $twitter)         // miast parametru z adresu można od razu przekazać że chcemy pobrać model którego kolumna (domyślnie id) odpowiada {wildcard} I TO DZIAŁA
    {
        //$project = Test::findOrFail($id);

        // $twitter = app('twitter');

        // dd($twitter);

        // if ($project->owner_id !== auth()->id()) {
        //     abort(403);         // jeśli id właściciela się nie zgadza - przerwij i zwróć błąd 403 = brak dostępu
        // }

        // abort_if($project->owner_id !== auth()->id(),403);          // identyczne jak powyższe

        // abort_unless(auth()->user()->owns($project), 403);          // kolejny przykład - dodanie metody owns do klasy user

        // $this->authorize('update',$project);            // robi to co powyższe ale z użyciem klasy Policy

        if(\Gate::denies('update', $project)){      // znowu to samo - tym razem z użyciem fasady \Gate
            abort(403);
        }

        return view('projects/show')->withProject($project);
    }

    public function store()
    {
        // $test = new Test;           // tworzymy nowy obiekt w modelu

        // $test->title = request('title');            // cechy obiektu są zapisywane z requesta (update polecenia - request pobiera dane z zapytania jakim dostaliśmy sięna stronę - get / post)
        // $test->desc = request('desc');

    //    $test->save();  // już wypełniony obiekt zapisujemy w bazie

        // Test::create([          // create zapisuje podane wartości do pól modelu i zapisuje (wymaga wypełnienie zmiennej $fillable w modelu)
        //     'title' => request('title'),
        //     'desc'  => request('desc')
        // ]);
        
        $validated = request()->validate([       // metoda sprawdzająca przesłane dane, tworzymy tabelę walidacji pól i zasady rozdzielane |  
            'title' => 'required | min:3 | max:255',
            'desc'  => 'required | min:3 | max:255'
        ]);

        $validated['owner_id'] = auth()->id();          // dodajemy do tablicy atrybutów id właściciela które pochodzi z helpera

        $project = Test::create($validated);            // jeszcze inna - krótsza forma przesłania do create tablicy

        // \Mail::to($project->owner->email)->send(     // tworzymy maila - do kogo->wyślij(co - nowy ProjectCreated)
        //     new ProjectCreated($project)
        // );

        event(new NewProject($project));            // ogłaszamy, że został stworzony nowy event i robimy z tym co potrzebujmy

        return redirect('/projects');       // ZWRACA redirecta na wybraną ścieżke
    }

    public function edit($id)       // jako parametr obiera oznaczony wcześniej {wildcard}
    {   
        if(\Gate::denies('update', $project)){      // znowu to samo - tym razem z użyciem fasady \Gate
            abort(403);
        }

        $project = Test::findOrFail($id);
        return view('projects/edit',)->withProject($project);
    }

    public function update(Test $project)
    {   
        //dd(request()->all());      // dd - die and dump szybki debugging

        // $project = Test::findOrFail($id);           // findOrFail po nieudanym przeszukaniu zwróci ekran 404

        // $project->title = request('title');
        // $project->desc = request('desc');

        // $project->save();

        if(\Gate::denies('update', $project)){      // znowu to samo - tym razem z użyciem fasady \Gate
            abort(403);
        }

        $validated = request()->validate([       // metoda sprawdzająca przesłane dane, tworzymy tabelę walidacji pól i zasady rozdzielane |  
            'title' => 'required | min:3 | max:255',
            'desc'  => 'required | min:3 | max:255'
        ]);

        $project->update($validated);            // bliźniacza do metody create dla modelu

        return redirect('/projects');
    }

    public function destroy(Test $project)
    {
        if(\Gate::denies('update', $project)){      // znowu to samo - tym razem z użyciem fasady \Gate
            abort(403);
        }
        
        $project->delete();  // znajdź i usuń, proste i piękne

        return redirect('/projects');
    }
}
